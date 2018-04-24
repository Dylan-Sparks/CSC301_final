/* Select jedi where the username and password match those passed as parameters */
SELECT *
FROM jedi
WHERE username = :username AND password = :password;
	