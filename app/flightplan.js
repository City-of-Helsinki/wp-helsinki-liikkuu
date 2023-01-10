/******************************************************************************
 *
 * #INDEX
 *
 * - INCLUDES - Include dependencies.
 * - CONFIGURATION - Define configuration.
 * - STAGES - Define stages (staging, production etc).
 * - DEPLOY TO REMOTE STAGE - Remote tasks.
 * - DATABASE TASKS - Database tasks.
 * - LOCAL SETUP TASKS - Local tasks.
 * - HELP TASK
 * - HELPER FUNCTIONS - Helper function.
 *
 ******************************************************************************/


/******************************************************************************
 *
 * #INCLUDES
 *
 ******************************************************************************/

var plan = require('flightplan');
var fs = require('fs');
var http = require('http');

var envPath = '/app/env/.env';

//if not available we must be local 
if (!fs.existsSync(envPath)) {
    envPath = './env/.env';
}

var dotenv = require('dotenv').config({path: envPath});


/******************************************************************************
 *
 * #CONFIGURATION
 *
 ******************************************************************************/

// Load local configuration from parent directory.
// var localConfig = require('./flightplan.local.js');
var localConfig = {}; //legacy fallback as file was removed

// Load project configuration from config-folder.
var projectConfig = require('./flightplan/project.conf.js');

// Get the current local project directory root
var localBuildPath = __dirname;

//tweak project conf from values in ENV
projectConfig.siteTitle = process.env.APP_TITLE;
projectConfig.themeName = process.env.WP_THEME_NAME;

/******************************************************************************
 *
 * #STAGES
 *
 ******************************************************************************/

for (var key in projectConfig.targets) {
	plan.target(key, projectConfig.targets[key].hosts, projectConfig.targets[key].options);
}



/******************************************************************************
 *
 * #INCLUDE DEPENDENCIES
 *
 ******************************************************************************/

require('./flightplan/lib/doc.js')(plan, projectConfig, localConfig);
require('./flightplan/lib/helpers.js')(plan, projectConfig, localConfig);
require('./flightplan/lib/deploy.js')(plan, projectConfig, localConfig, localBuildPath);
require('./flightplan/lib/db.js')(plan, projectConfig, localConfig, localBuildPath);