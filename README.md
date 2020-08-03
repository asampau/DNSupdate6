# DNSupdate6
Dynamic DNS Update from IPv6 addresses
This Projects Includes
----------------------
A single server with
BIND DNS named Server on Linux
Apache + PHP >= 4 Server Working on Linux (IPv6)
Both Public IPv4 and IPv6 addresses.
Zone Delegation to this public server

This example, shows my own Dynamic DNS v6 Project for my own domain brin.pc2linux.com

In SOA DNS pc2linux.com must exists 
brin.pc2linux.com       NS      nsbrin.pc2linux.com

And its A record
nsbrin      A       108.x.y.z

and optional dns6 record
nsbrin    AAAA      2800::::::::

