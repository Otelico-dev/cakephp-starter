1. Create table using migrations

bin/cake bake migration Create[TableName][field:type]

ex. bin/cake bake migration CreateMembers name:string

bin/cake migrations migrate

2. Create files using bake

bin/cake AdminTheme.AdminBake --table Members

3. Modify views
