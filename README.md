# Bus

## Best Practices

 - A _CommandHandler_ only handles one command, so one unique method public like __invoke__
 with a _Command_ as the unique argument expected is the best way to implement them.
