<?php
use \DepotServer\DSTickets;

$dst = new DSTickets();

print_r($dst->obtenerTicketsDelProyecto(1));