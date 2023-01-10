/******************************************************************************
 *
 * #DEPLOY TO REMOTE HOST
 *
 ******************************************************************************/

var Em = require('./Em');
var child_process = require('child_process');

module.exports = function(plan, projectConfig, localConfig, localBuildPath) {

	/**
	 * Rsync public-folder to remote host. Ignore files specified in flightplan/flightingnore
	 */
	plan.doc('deploy', 'Deploy files from public-folder to remote host (rsync).');
	plan.local('deploy', function(target) {

		Em.prompt(plan, target, plan.runtime.target, 'Are you sure you want to deploy to '+plan.runtime.target+'?');

		target.log("Deploying public folder to " +plan.runtime.hosts[0].host + ":" + plan.runtime.options.buildRoot+projectConfig.webRoot);

		target.exec('rsync -ave "ssh -o StrictHostKeyChecking=no" --exclude-from=flightplan/flightignore '+ localBuildPath + projectConfig.webRoot + '/* '+plan.runtime.hosts[0].username+'@'+plan.runtime.hosts[0].host+':'+plan.runtime.options.buildRoot+plan.runtime.options.webRoot);

		target.exec('rsync -ave "ssh -o StrictHostKeyChecking=no" --exclude-from=flightplan/flightignore '+ localBuildPath + '/vendor/* '+plan.runtime.hosts[0].username+'@'+plan.runtime.hosts[0].host+':'+plan.runtime.options.buildRoot+'/vendor');

		if(plan.runtime.options.log == true && process.env.DEV_HOST_HOSTNAME !== 'undefined'){

			var commit, branch;

			//lets get the last commit to show in slack
			child_process.exec('git rev-parse --short HEAD', function(err, stdout) {

				commit = stdout.replace(/(\r\n|\n|\r)/gm,"");

				child_process.exec('git rev-parse --abbrev-ref HEAD', function(err, stdout) {
					branch = stdout.replace(/(\r\n|\n|\r)/gm,"");

					Em.writeLog(target, "`"+process.env.DEV_HOST_HOSTNAME+"` deployed `"+branch+"` `"+commit+"` to `"+plan.runtime.options.url+"`");
				});

			});

		}

	});

}
