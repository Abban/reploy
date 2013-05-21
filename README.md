Reploy
=======

Testing Github repo deployment. This is a work in progress, unless you want to contribute I wouldn't recommend using it.

# Installation

For now it needs a manual installation.

1. Create a table in your database.
2. Import the tables from <code>installation > tables.sql</code>.
3. Open <code>application > config > database.php</code> and add your database details.
4. Navigate to whatever URL you set it up on and hit the login button. It will then validate through Github Oauth.

# To Do

* Encryption for FTP data.
* Installation script.
* FTP through php has been proofed but a functionality needs to be written to do the following:
    * Get changes from Github
    * Replace updated files and folders
    * Deleted removed files and folders
    * Full redeploy
* Better relationships between users and repos.
    * Best would be if a user adds a repo already added by another user they get added as a member of that on the system. They can then see other users deployments for that repo.