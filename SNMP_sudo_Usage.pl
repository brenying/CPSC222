#!/usr/bin/perl

@DATA = `grep -a  "pam_unix(sudo:session): session opened" /var/log/auth.log`;
my $sudocnt = 0; #declare a counter

foreach my $line (@DATA) {
	chomp($line);
	$sudocnt++; # increment
}

print $sudocnt;
