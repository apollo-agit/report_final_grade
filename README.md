# report_final_grade

## Summary
This is a standard Moodle Plugin that provides an admin level view to all courses and there final grade.

## Features

* The user can search for the course idnumber based on either the term or crn portion. ie: 2134.201601.
..* User can search by 2134 or both
..* User can search by 201601 or both
..* User cab searcg by 2134.201601
* This search is done as a LIKE clause which will bring back any and all data coresponding to the wildard scenario.
* The feature allows on screen view and a downloadable csv text file

## Considerations
1. This plugin does run a LIKE clause, which makes the query powerful. It also forces us to hand work the query. The moodle LIKE api is used, but join considerations are appened. This can be viewed here...[Renderer](finalgrade/classes/renderer.php). 
