DBQuery.shellBatchSize = 300000
db.user_contents.aggregate([{
"$project": {
    "tags": 1
}
}, {
"$unwind": "$tags"
}, {
"$group": {
    "_id": "$tags",
    "count": {
        "$sum": 1
    }
}
}]);