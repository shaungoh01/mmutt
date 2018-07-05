<paper-header-panel drawer style="background-color:#E8EAF6; margin:0;">
	<img src="MMUTTLogoWWordLarge.png" style="width:256px;" alt="Logo">
	<paper-menu style="margin:0; background-color:#E8EAF6;">
		<paper-item icon="today" label="Calendar"><iron-icon icon="today"></iron-icon>Calendar</paper-item>
		<paper-item paper-dialog-toggle="" icon="cloud" label="Sync to Google" onclick="document.querySelector('.syncbox').toggle();"><iron-icon icon="cloud"></iron-icon>Copy To Google</paper-item>
		<a class="sideBarL" href="logout.php"><paper-item icon="exit-to-app" label="Sign Out"><iron-icon icon="exit-to-app"></iron-icon>Sign Out</paper-item></a>
	</paper-menu>
</paper-header-panel>