#Set user.name
git config --global user.name "Samitha Hewawasam"
git config --global user.email "eupdate@users.noreply.github.com"
#display the set of config 
git config --list
echo "Enter the htdocs PATH"
read $htdocs
#change the directory to the htdocs PATH
cd $htdocs
#setup GIT
git init
#SSH GITHUB
 #Generate a new SSH key
 ssh-keygen -t rsa -C "eupdate@users.noreply.github.com"
 #Add your key to the ssh-agent
   #Ensure ssh-agent is enabled:
   eval "$(ssh-agent -s)"
 #Add your generated SSH key to the ssh-agent:
   ssh-add ~/.ssh/id_rsa
echo "Now add your SSH key to your account"
#Test the connection
ssh -T git@github.com

#Add upstream and origin to the git remote -v

git add remote 

git remote add origin git@github.com:eupdate/system.git
git remote add upstream git@github.com:eupdate/system.git

# Verify new remotes
git remote -v

#pull from master
echo "Everything is all right ?"
git pull -u upstream master




