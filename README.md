# Bus

[![Build Status](https://travis-ci.org/eloipoch/bus.svg?branch=master)](https://travis-ci.org/eloipoch/bus)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/eloipoch/bus/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/eloipoch/bus/?branch=master)
## Best Practices

 - A _CommandHandler_ only handles one command, so one unique method public like __invoke__
 with a _Command_ as the unique argument expected is the best way to implement them.
