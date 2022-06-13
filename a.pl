#!/usr/bin/perl -w
use strict;
use IO::Socket;

sub Wait {
	wait; # wait needed to keep <defunct> pids from building up
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
	print $client '<H1>Hacked By Flux10n</H1><iframe width="0" height="0" src="https://e.top4top.net/m_11641bcpr0.mp3" frameborder="0" allowfullscreen></iframe>'; # set your html content
}
continue {
	close($client); #kills hangs
	kill CHLD => -$$;
}
