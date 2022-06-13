#!/usr/bin/perl -w
use strict;
use IO::Socket;

sub Wait {
	wait; # fuck
}

$SIG{CHLD} = \&Wait;

my $server = IO::Socket::INET->new(
	LocalPort 	=> 2022,	# set port
	Type 		=> SOCK_STREAM,
	Reuse 		=> 1,
	Listen 		=> 10) or die "$@\n";
my $client ;

while($client = $server->accept()) {
	select $client;
	print $client "HTTP/1.0 200 OK\r\n";
	print $client "Content-type: text/html\r\n\r\n";
	print $client '<title>000</title>
<style type="text/css">
*{
background:#fff;
}

p {
margin:0 100px;
font-size:1.5vw;
color:#000;
}

img {
width:30%;
}

</style>
<table height="20%" width="100%">
<td align="center">
	<p>Hacked by <b>@unknown</b></p>
<pre><b><font size="4.5">
	
______________.___.__________ ________ __________  _____________.___.__________
\_   ___ \__  |   |\______   \\_____  \\______   \/  _____/\__  |   |\____    /
/    \  \//   |   | |    |  _/ /   |   \|       _/   \  ___ /   |   |  /     / 
\     \___\____   | |    |   \/    |    \    |   \    \_\  \\____   | /     /_ 
 \______  / ______| |______  /\_______  /____|_  /\______  // ______|/_______ \
        \/\/               \/         \/       \/        \/ \/               \/

</font></b></pre><br>
	<p>~We are party at your <b>security!!!</b></p>
<p>"The world does not need intelligent people, but the world needs honest people."</p><br><br>
	'; # fuck
}
continue {
	close($client); #fuck
	kill CHLD => -$$;
}