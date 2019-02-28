#Bargaining Experiment Task

How to install

Refer to http://www.creedexperiment.nl/PEEP/intro.php for details and resources.

Installation Instructions on a local server on MAC

1. Download and install MAMP on your computer.
2. Save the application (binaries) into the folder /Applications/MAMP/htdocs/
3. Turn on the servers by opening the MAMP application and clicking "Start Servers".
4. Import Database into mySQL
	i. Go to phpMyAdmin (installed with MAMP). You can do this by either
		a. Clicking "Open Webstart page" -> Tools -> PHYMYADMIN
		b. Typing in the browser http://localhost:8888/ -> Tools -> PHYMYADMIN	
	ii. Create a new DATABASE by clicking new. Call it "sliders".
	iii. Import DATABASE by clicking Import and selecting the file "sliders.sql"
	iv. Check that values in the database are allowed to be NULL. If not, I recommend 		changing them in SequelPRO. Errors Inserting rows into the database are probably because of this.

Manage SQL data (Can also import through this app):
I. Install sequel PRO
II. Connect MAMP database:
- Socket:
	- Name: localhost
	- Username: root
	- Password: root 

5. Change preferences of MAMP to php 5.6... . If the version doesn't appear, go to /Applications/MAMP/bin/php and remove the php version that you don't need (leave only two).  Restart MAMP and change preferences.

Run Experiment on a MAC
1. Experimenter: 
Go to http://localhost:8888/Binaries_folder/monitor.php
i. Erase current data.
ii. After data is erased, choose the  and change parameters (under setup)
iii. Later on, when everyone is ready to start you will need to press the "Start Experiment" in this screen.
iv. When all participants are done click on "Calculate total Earnings" to calculate total earnings. :P


2. Participant: Open browser and go to http://localhost:8888/Binaries_folder
	i. Participant number will be provided automatically in order of arrival.
		- It is possible to relogin with a specific participant id by going to http://localhost:8888/Binaries_folder/relogin.html
	ii. Go through instructions and to the quiz. If testing you can skip all the instructions by typing now (don't skip step i. or the participant ID will not be allocated - this is done via cookies -) http://localhost:8888/Binaries_folder/waittostart.php.
	iii. Wait until experimenter presses "Start Experiment"




