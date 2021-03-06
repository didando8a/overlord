overlord
File to be executed: runGame.php

Php Client App that receives the number of monsters as argument and create a world where evils will fight

You are given a map containing the names of cities in the non-existent world of X. The map is in a file, with one city per line. The city name is first, followed by 1-4 directions (north, south, east, or west). Each one represents a road to another city that lies in that direction.

For example:

Foo north=Bar west=Baz south=Qu-ux Bar south=Foo west=Bee ...

The city and each of the pairs are separated by a single space, and the directions are separated from their respective cities with an equals (=) sign.

In this world you are competing to be the evil overlord, so you create many monsters to go forth and cause trouble. You should create N monsters, where N is specified as a commandline argument.

These monsters start out at random places on the map, and wander around randomly, following links. Each iteration, the monsters can travel in any of the directions leading out of a city. In our example above, a monster that starts at Foo can go north to Bar, west to Baz, or south to Qu-ux.

When two monsters end up in the same place, they fight, and in the process kill each other and destroy the city. When a city is destroyed, it is removed from the map, and so are any roads that lead into or out of it.

In our example above, if Bar were destroyed the map would now be something like:

Foo west=Baz south=Qu-ux

Once a city is destroyed, monsters can no longer travel to or through it. This may lead to monsters getting "trapped" -- that's ok, you don't care, because you're an evil overlord.

ASSUMPTIONS

The city name must be formed by just one word
There is no fight on generation of monsters
Two or more monsters can fight in the same city
When two monsters (or more) fight, the city is destroyed but they can leave it by going through its neighbors