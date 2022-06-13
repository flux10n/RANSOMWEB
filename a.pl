#!/usr/bin/perl -w
use strict;
use IO::Socket;

sub Wait {
	wait; # iyh
}

$SIG{CHLD} = \&Wait;

my $server = IO::Socket::INET->new(
	LocalPort 	=> 1337,	# set port
	Type 		=> SOCK_STREAM,
	Reuse 		=> 1,
	Listen 		=> 10) or die "$@\n";
my $client ;

while($client = $server->accept()) {
	select $client;
	print $client "HTTP/1.0 200 OK\r\n";
	print $client "Content-type: text/html\r\n\r\n";
	print $client '<h1>Hacked by Flux10n</h1>'; # script deface
}
continue {
	close($client); #fuck
	kill CHLD => -$$;
}
