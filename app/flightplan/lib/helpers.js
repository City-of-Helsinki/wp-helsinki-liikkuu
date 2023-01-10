/******************************************************************************
 *
 * #HELPERS
 *
 ******************************************************************************/

var fs = require('fs');

module.exports = function(plan, projectConfig) {

	/** 
	 * Return true if task is run with --dry command.
	 */
	plan.isDryRun = function() {
		var found = false;
		process.argv.forEach(function (val, index, array) {
  			if (val === "--dry") {
				found = true;
			}
		});
		return found;
	}

	plan.doc('test', 'Test remote connection.');
	plan.remote('test', function(target) {

		target.log('Running test on '+target.runtime.host);

		target.exec('cd '+plan.runtime.options.buildRoot+plan.runtime.options.webRoot+' && pwd');

		target.log('Heres some runtime info of this target:');

		for(var i in plan.runtime.options){
			target.log(i+' : '+plan.runtime.options[i]);
		}

		for(var i in target.runtime){
			target.log(i+' : '+target.runtime[i]);
		}

	});

	plan.doc('ping', 'ping remote connection.');
	plan.local('ping', function(target) {

		target.log('Running ping on '+projectConfig.targets[plan.runtime.target].hosts.host);

		target.exec('ping -q -c 1 '+projectConfig.targets[plan.runtime.target].hosts.host);

	});

	swapNamespace = function(to, from){
		var obj = {};

		// changing the namespace to from hy-pen to camelCase
		obj.to = from.replace(/-([a-z0-9])/g, function (g) { return g[1].toUpperCase(); });

		// now capitalize first letter of our CamelCase
		obj.to = obj.to.charAt(0).toUpperCase() + obj.to.slice(1);

		// capitiliaze first letter of our Original
		obj.from = to.charAt(0).toUpperCase() + to.slice(1);

		return obj;
	}

	plan.doc('addBlock', 'Add a block');
	plan.local('addBlock', function(target) {

		// check if we have a block name to use
		if(typeof(plan.runtime.options.block) === 'undefined') {
			throw new Error('Christian Bale\'n oot, block name is empty'); 
		}

		var type = 'page';
		var blocksPath = 'src/wp-content/themes/' + process.env.WP_THEME_NAME + '/lib/blocks/' + type;
		var block = plan.runtime.options.block + '-block';
		var name = plan.runtime.options.block;

		// if name is omitted default to block name
		if(plan.runtime.options.name) {
			name = plan.runtime.options.name;
		}

		// check if our block by name already exists
		if (!fs.existsSync(blocksPath + '/' + name)) {
			target.with("cd " + blocksPath, function() {

				// clone the block into the folder
				target.exec('git clone git@bitbucket.org:evermade/' + block + '.git ' + name);
				
				target.with("cd " + name, function() {

					var namespace = swapNamespace(plan.runtime.options.block, name);
					
					var sed = "sed -i 's/"+namespace.from+"/"+namespace.to+"/g'";
					
					//fix namespace
					target.exec("find . -type f -exec "+sed+" {} +");

					// delete git folder to we attach the block to the project
					target.exec('rm -rf .git');

				});
			});
		}
		else {
			console.log('Block [' + name + '] already exists!');
		}
		
	});

}

