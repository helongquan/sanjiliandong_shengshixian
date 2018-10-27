#!/bin/bash                                                                                          
git add .
echo "already add into local reposity."
riqi=`date "+%Y-%m-%d-%H:%M:%S+update"`
git commit -m $riqi
echo "finish commit"
git push origin master
echo "push to remote successed!"
