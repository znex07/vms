@ECHO OFF
npm install
npm run dev
git add .
git commit -m update
git pull origin master
PAUSE
