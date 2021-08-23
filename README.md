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

When DNS make any change on zone, I receive an email saying
-----------------------------------------------------------

CambiosEnDNS-pc2linux-tektonic.pc2linux.com
Inbox
Tektonic@pc2linux.com
	
Sun, Aug 22, 10:45 PM (11 hours ago)
	
to me
$TTL 86400
@   IN  SOA     tektonic.pc2linux.com. asampau.gmail.com. (
        2021082300  ;Serial
        3600        ;Refresh
        1800        ;Retry
        604800      ;Expire
        86400       ;Minimum TTL
)
; Specify our two nameservers
                IN      NS              ns1.tektonic.pc2linux.com.
                IN      NS              ns2.tektonic.pc2linux.com.
; Resolve nameserver hostnames to IP, replace with your two droplet IP addresses.

; Define hostname -> IP pairs which you wish to resolve
@               IN      A               108.161.137.89
www             IN      A               108.161.137.89
AddHost2Domain  IN      AAAA    2606:4300:0:4::100e
asampau-Presario-21     IN      AAAA    2800:810:487:870e:c14a:d5a3:d94a:331a
asampau-ThinkPad-L430   IN      AAAA    2800:810:557:8ec5:ddb9:b4fa:4025:aa5d
...

