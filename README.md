# dropship_simpleUI
Simple UI and package for sending requests to 3rd party API for dropshipped orders. Monitors response and emails when there's an issue. Interface can be checked to monitor status of orders. Really simple. No, really really simple. 

Built early on in my career and putting up for public review now. I believe there's a number of files that were never used and ideas that were never seen to completion as this was just an in-house tool and complexity was less desireable than expedience. 

A cronjob kicks off a process that results in a loop over a txt file and an API call for each loop.
