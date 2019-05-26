<?php

session_start();
include '../includes/config.php';
include '../includes/hasPerms.php';
include '../includes/calculation.php';

include '../includes/header.authed.php';
?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<center><h3 class="panel-title"></h3></center>
					</div>       <!--Major x, Minor x-9, Patch x-9 --->
					
					<div class="panel-body">
						<blockquote>
							<p>UPDATE LOG (26/05/2019 23:00) #8</p>
							<p><h3>Alpha Version 1.8.0</h3></br></p>
                            <p>-<span class="label label-success">ADDED</span> PRIVAT RECHNER/ INVOICE</p>
                            <p>-<span class="label label-success">ADDED</span> PRIVAT CONTRACT-BOOK REFACTORED</p>
                            <p>-<span class="label label-success">ADDED</span> ADD OR REMOVED A CONTRACT PARTNER</p>
							<p>-<span class="label label-success">ADDED</span> ADMIN PANEL REFACTORED</p>
							<p>-<span class="label label-warning">CHANGED</span> DROBDOWN MENU REFACTORED</p>
							<p>-<span class="label label-warning">CHANGED</span> DATABASE REFACTORED</p>
                            <p>-<span class="label label-info">FIXED</span> COMPANY PROFIT</p>
                            <p>-<span class="label label-info">FIXED</span> Fixed some bugs</p>
						</blockquote>
					</div>
					<div class="panel-body">
						<blockquote>
							<p>UPDATE LOG (20/05/2019 22:42) #7</p>
							<p><h3>Alpha Version 1.7.0</h3></br></p>
                            <p>-<span class="label label-success">ADDED</span> ADMIN PANEL REFACTORED</p>
						</blockquote>
					</div>
					<div class="panel-body">
						<blockquote>
							<p>UPDATE LOG (20/05/2019 17:40) #6:</p>
							<p><h3>Alpha Version 1.6.0</h3></br></p>
							<p>-<span class="label label-success">ADDED</span>  DATABASE PRICING , Dust MC</p>
							<p>-<span class="label label-primary">REMOVED</span> DATABASE REMOVED Ballas</p>
						</blockquote>
					</div>
					<div class="panel-body">
						<blockquote>
							<p>PATCH (19/05/2019 13:10) #1:</p>
							<p><h3>Alpha Version 1.5.1</h3></br></p>
                            <p>-<span class="label label-info">FIXED</span> HOLIDAY SYSTEM</p>
						</blockquote>
					</div>
					<div class="panel-body">
						<blockquote>
							<p>UPDATE LOG (16/05/2019 04:44) #5:</p>
							<p><h3>Alpha Version 1.5.0</h3></br></p>
							<p>-<span class="label label-success">ADDED</span> ORDERS SYSTEM</p>
							<p>-<span class="label label-success">ADDED</span> ORDERS LIST</p>
							<p>-<span class="label label-success">ADDED</span> COMPANY VEHICLES</p>
                            <p>-<span class="label label-warning">CHANGED</span> DATABASE REFACTORED</p>
						</blockquote>
					</div>
					<div class="panel-body"> <!--Major x, Minor x-9, Patch x-9 --->
						<blockquote>
							<p>UPDATE LOG (12/05/2019 17:55) #4:</p>
							<p><h3>Alpha Version 1.4.0</h3></br></p>
							<p>-<span class="label label-success">ADDED</span> HOLIDAY SYSTEM</p>
                            <p>-<span class="label label-success">ADDED</span> HOLIDAY PAGE</p>
                            <p>-<span class="label label-info">FIXED</span> Fixed some bugs</p>
						</blockquote>
					</div>
					
					<div class="panel-body"> <!--Major x, Minor x-9, Patch x-9 --->
						<blockquote>
							<p>UPDATE LOG (11/05/2019 00:02) #3:</p>
							<p><h3>Alpha Version 1.3.0</h3></br></p>
							<p>-<span class="label label-success">ADDED</span> STAAT ORDERS REVISED</p>
                            <p>-<span class="label label-success">ADDED</span> STAAT DESCRIPTION</p>
                            <p>-<span class="label label-success">ADDED</span> STATE NUMBER OF SERVICES AND MARKERS REQUIRED TO REGISTER</p>
                            <p>-<span class="label label-success">ADDED</span> LOGIN TIME EXTENDED (AUTOMATISCH ALLE 28 MIN NEU LADEN DER SEITE)</p>
                            <p>-<span class="label label-info">FIXED</span> Fixed some bugs</p>
						</blockquote>
					</div>
					
					<div class="panel-body">
						<blockquote>
							<p>UPDATE LOG (01/05/2019 19:35) #1:</p>
                             <p><h3>Alpha Version 1.2.0</h3></br></p>
								<p>-<span class="label label-success">ADDED</span> RADIO DISCIPLINE</p>
                                <p>-<span class="label label-success">ADDED</span> BLACKBOARD</p>
                                <p>-<span class="label label-success">ADDED</span> Admin can delete Orders by ID</p>
								<p>-<span class="label label-info">FIXED</span> Authentication</p>
                                <p>-<span class="label label-info">FIXED</span> Fixed some bugs</p>
						</blockquote>
					</div>
					
					<div class="panel-body">
						<blockquote>
							<p>PATCH (28/04/2019 15:15) #1:</p>
							 <p><h3>Alpha Version 1.1.1</h3></br></p>
                            <p>-<span class="label label-info">FIXED</span> STAATS RECHNER</p>
						</blockquote>
					</div>
					
					<div class="panel-body">
						<blockquote>
							<p>CHANGELOG 27/04/2019 00:50 & (28/04/2019 14:35) #1:</p>
							<p><h3>Alpha Version 1.1.0</h3></br></p>
                                <p>-<span class="label label-success">ADDED</span> PROFILE (PASSWORD CHANGER)</p>
                                <p>-<span class="label label-success">ADDED</span> BOSS/ADMIN PANEL (MEMBER PROMOTE/DEMOTE)</p>
								<p>-<span class="label label-success">ADDED</span>  DATABASE PRICING , HIGH EXPRESS , TOM BRADLEY, Pipeline Automotives</p>
                                <p>-<span class="label label-warning">CHANGED</span> DATABASE REFACTORED</p>
						</blockquote>
					</div>
					
				   <div class="panel-body">
						<blockquote>
							<p>UPDATE LOG (27/04/2019 23:15) #1:</p>
							<p><h3>Alpha Version 1.0.0</h3></br></p>
                                <p>-<span class="label label-success">ADDED</span> URL REBRANDING</p>
                                <p>-<span class="label label-success">ADDED</span> URL PATH SOLUTION</p>
                                <p>-<span class="label label-success">ADDED</span> COMPANY & USER PROFIT</p>
                                <p>-<span class="label label-success">ADDED</span> AUTHENTICATION SYSTEM REFACTORED</p>
                                <p>-<span class="label label-success">ADDED</span> BOSS/ADMIN PANEL REFACTORED</p>
                                <p>-<span class="label label-success">ADDED</span> TODO LIST</p>
								<p>-<span class="label label-success">ADDED</span> PROFILE (PASSWORD CHANGER)</p>
                                <p>-<span class="label label-success">ADDED</span> BOSS/ADMIN PANEL (MEMBER PROMOTE/DEMOTE)</p>
                                <p>-<span class="label label-success">ADDED</span> DATABASE REFACTORED</p>
								<p>-<span class="label label-primary">REMOVED</span> REMOVED FILE ENDINGS</p>
						</blockquote>
					</div>
					
				</div>
            </div>
        </div>
    </div>
<body>
<?php
include '../includes/footer.php';
?>