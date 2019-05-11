# StreamerEventViewer

Link for live demo: http://streamer-event-viewer1.herokuapp.com

## Questuions

- How would you deploy the above on AWS?
    - I would choose the default stack with EC2 and RDS at first. Unfortunately, I haven't deployed to AWS any projects from scratch before.
    Everytime when I worked with it - it was already configured.
    So I haven't a very big experience with it.
    But will enjoy to try.

- Where do you see bottlenecks in your proposed architecture and how would you approach scaling this app starting from 100 reqs/day to 900MM reqs/day over 6 months?
    - In order to scaling up this app I suggest to use some kind of a load balancer (like haproxy) to divide the load for several instances.
     Also some stuff that doesn't require instant response can be moved to the queue (like saving events in the database) and some instance (maybe not one) with several workers will handle it.
     Of course, some kind of caching should be added (data that is seldom updated but often requested). 
