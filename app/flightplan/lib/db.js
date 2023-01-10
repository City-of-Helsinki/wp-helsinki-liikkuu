/******************************************************************************
 *
 * #PUSH AND PULL DATABASE
 *
 ******************************************************************************/

var Em = require('./Em');

module.exports = function(plan, projectConfig, localConfig) {

	/**
	 * Create mysql dump and upload to target servers.
	 */
	plan.doc('dbPush', 'Push database to remote host.')
	plan.local('dbPush', function(target) {

		if(!Em.checkDbCredentials(plan.runtime.target)){
			throw new Error('bailing out db push, credentials are wonky'); 
		} 

		if(typeof(plan.runtime.options.dbPush) === 'undefined' || plan.runtime.options.dbPush == false){
			throw new Error('bailing out db push, not allowed amigo'); 
		}

		// Create backup dir for dumps.
		target.exec("mkdir backups", {failsafe:true});

		// Make sql dump.
		target.exec("mysqldump -h" + process.env.APP_DB_HOST + " -u" + process.env.MYSQL_USER + " -p" + process.env.MYSQL_PASSWORD + " " + process.env.MYSQL_DATABASE + " > backups/dump-local.sql");

		//Upload to target.
		var host = plan.runtime.hosts[0];

		target.exec("rsync -ve \"ssh -o StrictHostKeyChecking=no\" "+ "backups/dump-local.sql "+ host.username + "@" + host.host + ":" + plan.runtime.options.buildRoot + "/backups/");

	});

	/**
	 * Insert mysql dump and replace WP strings.
	 */
	plan.remote('dbPush', function(target) {

		target.with("cd " + plan.runtime.options.buildRoot, function() {

			// Create backup dir for dumps.
			target.exec("mkdir backups", {failsafe:true});

			// Insert dump.
			target.exec("mysql -h" + Em.getDbCredential(plan.runtime.target, 'MYSQL_HOST') + " -u" + Em.getDbCredential(plan.runtime.target, 'MYSQL_USER') + " -p" + Em.getDbCredential(plan.runtime.target, 'MYSQL_PASSWORD') + " " + Em.getDbCredential(plan.runtime.target, 'MYSQL_DATABASE') + " < backups/dump-local.sql")

		});

		target.with("cd "+plan.runtime.options.buildRoot+plan.runtime.options.webRoot, function() {
			target.exec("wp --allow-root search-replace 'http://"+process.env.APP_URL+"' '"+plan.runtime.options.url+"'");
		});

	});



	/**
	 * Dump database on remote host.
	 */
	plan.doc('dbPull', 'Pull database from remote host.')
	plan.remote('dbPull', function(target) {

		if(!Em.checkDbCredentials(plan.runtime.target)){
			throw new Error('bailing out db push, credentials are wonky'); 
		}

		target.with("cd " + plan.runtime.options.buildRoot, function() {

			// Create backup dir for dumps.
			target.exec("mkdir backups", {failsafe:true});

			// Create dump.
			target.exec("mysqldump -h" + Em.getDbCredential(plan.runtime.target, 'MYSQL_HOST') + " -u" + Em.getDbCredential(plan.runtime.target, 'MYSQL_USER') + " -p" + Em.getDbCredential(plan.runtime.target, 'MYSQL_PASSWORD') + " " + Em.getDbCredential(plan.runtime.target, 'MYSQL_DATABASE') + " > backups/dump-remote.sql")

		});

	});

	/**
	 * Insert remote dump to local db and replace domains.
	 */
	plan.local('dbPull', function(target) {

		// Create backup dir for dumps.
		target.exec("mkdir backups", {failsafe:true});

		// Download from the first host.
		var host = plan.runtime.hosts[0];

		target.exec("rsync -ve \"ssh -o StrictHostKeyChecking=no\" " + host.username + "@" + host.host + ":" + plan.runtime.options.buildRoot + "/backups/dump-remote.sql " + "backups/dump-remote.sql");

		// Insert downloaded dump.
		target.exec("mysql -h" + process.env.APP_DB_HOST + " -u" + process.env.MYSQL_USER + " -p" + process.env.MYSQL_PASSWORD + " " + process.env.MYSQL_DATABASE + " < backups/dump-remote.sql");

		target.with("cd dist/", function() {
			target.exec("wp --allow-root search-replace '"+plan.runtime.options.url+"' 'http://"+process.env.APP_URL+"'");
			target.exec("wp --allow-root search-replace 'https' 'http'");
		});

	});

}
