### Billplz Assignment - Laravel Backend Dev

Notes:
- Some of the answers provided in commands.
- You can clone this repo to run the commands, no much hustles, just a simple command for you to get the output.
- Also, I submitted the answers in .docx format in the email. 

#### 1. Password Generator

```
php artisan generate:password
```

#### 2. Simple Pizza Ordering

```
php artisan order:pizza
```

#### 3. Users have many credits, each credit has a balance column and created datetime (timezone UTC). Write an SQL statement to retrieve users’ last credit balance on 31st December 2022.

```
SELECT user_id, balance
FROM credits c1
WHERE created_at = (
    SELECT MAX(created_at)
    FROM credits c2
    WHERE c2.user_id = c1.user_id AND c2.created_at <= '2022-12-31 23:59:59'
);
```

#### 4. What is the difference between after_save VS after_commit? (Rails) OR What is the difference between saved VS afterCommit? (Laravel)

```
- `saved` will directly triggered the event after model saved even before transaction committed and without considering any errors.
- `afterCommit` will trigger after the transaction have been committed.
```

#### 5. Users’ have many comments and comments can be liked by other users. Write an SQL statement to count how many users liked that comment. 

```
SELECT comments.user_id, comments.id AS comment_id, COUNT(comment_likes.id) AS total_likes
FROM comments
LEFT JOIN comment_likes ON comments.id = comment_likes.comment_id
GROUP BY comments.id, comments.user_id;
```

#### 6. A snail can climb up 3 meters a day and it will drop 2 meters at night. The well is 11 meters deep. How many days will the snail need to come out from the well and the snail starts climbing in the morning?

```
php artisan snail:climb-days
```


