/******************************************************************************
 *
 * #HELP
 *
 * This module will add documentation support to flightplan. When creating 
 * new tasks, you can document the task as follows:
 * 
 * plan.doc('help', 'Output this help.')
 * plan.local('help', function(target) {}
 *
 * Documentation defined like that will be printed, when you run help-task.
 *
 * Such beautiful.
 *
 ******************************************************************************/

module.exports = function(plan, projectConfig) {


	/**
	 * Object containing documentation.
	 */
	plan._docList = {};


	/**
	 * Extend flightplan to support documentation. 
	 */
	plan.doc = function(task, description) {

		plan._docList[task] = description;

	}

	/**
	 * Output help.
	 */
	plan.doc('help', 'Output this help.')
	plan.local('help', function(target) {

		target.log(" ");
		target.log("               _________");
		target.log("              |#########|						");
		target.log("              |#########|						");
		target.log("              |#########|			- Hello developer!	");
		target.log("              |#########|         ");
		target.log("              |#########|           ");
		target.log("            __|_________|__					");
		target.log("              |     '_ ' \					");
		target.log("              F     (.) (.)--.__				");
		target.log("             /                  '.			");
		target.log("            J                    |			");
		target.log("            F       ._          .'			");
		target.log("           J          '-.____.-'				");
		target.log("           F           \						");
		target.log("          J             \						");
		target.log("          |              \---					");
		target.log("          |  .  '.        \_E					");
		target.log("          |   '.  '.       L					");
		target.log(" '''      |     '.  '.     |					");
		target.log("\VVV'     |       '.  '    |					");
		target.log(" \W|      J         '''    F					");
		target.log("  '.    .' \              /					");
		target.log("    '--'    )    ____.-  '					");
		target.log("           /    /   '.   '.  .-				");
		target.log("          /   .'      '.   ' /				");
		target.log("          '.  \         '.   /				");
		target.log("            '._|          '-'    				");
		target.log("												");


		for (var task in plan._docList) {
			target.log(task.padRight(20, " ") + plan._docList[task]);
		}

	});

	// Extend string to support padding.
	String.prototype.padRight = function(l,c) {return this+Array(l-this.length+1).join(c||" ")}



}

