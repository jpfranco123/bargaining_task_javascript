# Bargaining Experiment Task

## 0. Task Overview

In the game two participants bargain on how to split an amount of money: the pie-size. Only one participant (the informed player) is told the total amount of money (pie- size) in each trial. However, both participants know that the pie-size is chosen randomly between $2 or $6, with equal probability, in each trial.

During each trial participants negotiate by moving a cursor on a slider that represent values from $0 to $6. Amounts on the slider represent the uninformed player’s payment. During the first 5 seconds, participants select their initial offers (the initial position of the cursor is random). In the following 20 seconds they bargain with the other player. 

Clicking the mouse on a different part of the slider moves the cursor. A deal is made when both cursors are in the same place for 2 seconds or if both sliders are matching when the time is over. If no deal has been made after 20 the seconds of bargaining, both participants get $0. If a deal is made, the informed participant’s payment is equal to the pie-size minus the negotiated uninformed participant’s payment.

Participants are assigned randomly at the beginning of each session to be either informed or uninformed for the whole experiment. However, both type of participants are shown the same instructions and do not know their role until bargaining starts. Informed and uninformed participants are randomly matched before each trial with a (potentially) different participant. After each trial both participants are informed about the pie-size and their corresponding payments.

## 1. How to install

Refer to http://www.creedexperiment.nl/PEEP/intro.php for more resources and a guide on how to build a task (e.g. experiment) in JavaScript.

### Installation Instructions on a local server on a MAC

1. Download and install MAMP on your computer.
2. Save the application (binaries) into the folder /Applications/MAMP/htdocs/. Call the folder "bargaining_task_javascript".
3. Turn on the servers by opening the MAMP application and clicking "Start Servers".
4. Change preferences of MAMP to php 5.6.... If the version doesn't appear, go to /Applications/MAMP/bin/php and remove the php version that you don't need (leave only two). Restart MAMP, change preferences and start servers.
5. Import Database into mySQL
	- Via phpMyAdmin
		1. Go to phpMyAdmin (installed with MAMP). You can do this by either
			- Clicking "Open Webstart page" -> Tools -> PHYMYADMIN
			- Typing in the browser http://localhost:8888/ -> Tools -> PHYMYADMIN	
		2. Create a new DATABASE by clicking new. Call it "sliders".
		3. Import DATABASE by clicking Import and selecting the file "sliders.sql"
		4. Check that values in the database are allowed to be NULL. Otherwise change properties of the columns to allow for NULL (Errors Inserting rows into the database are probably because of this).
	- Via SequelPro (recommended for arbitrary reasons)
		1. Install SequelPro
		2. Connect MAMP database. Select Socket option an type the following options:
			- Name: localhost
			- Username: root
			- Password: root 
		3. Create a new DATABASE by clicking DATABASE -> Add DATABASE. Call it "sliders".
		4. Import DATABASE by clicking File -> Import and selecting the file "sliders.sql".
		5. Check that values in the database are allowed to be NULL. Otherwise change properties of the columns to allow for NULL (Errors Inserting rows into the database are probably because of this).

## 2. Run experiment

Upload the task to a server (requires similar setup as on step 1) and replace http://localhost:8888 with the server web address. 

You may also test the game using a single computer by using two different browsers within your computer. This option allows you to test the game on your local machine using MAMP. 

### 1. Experimenter: 
Go to http://localhost:8888/bargaining_task_javascript/monitor.php

1. Erase current data.
2. After data is erased, choose the  and change parameters (under setup).
3. Later on, when everyone is ready to start you will need to press the "Start Experiment" in this screen.
4. When all participants are done click on "Calculate total Earnings" to calculate total earnings. :P


### 2. Participant: 
Open browser and go to http://localhost:8888/bargaining_task_javascript

1. Participant number will be provided automatically in order of arrival.
	- It is possible to relogin with a specific participant id by going to http://localhost:8888/bargaining_task_javascript/relogin.html
2. Go through instructions and to the quiz. If testing you can skip all the instructions by typing now  http://localhost:8888/bargaining_task_javascript/waittostart.php (don't skip step 1. or the participant ID will not be allocated - this is done via cookies -).
3. Wait until experimenter presses "Start Experiment".




