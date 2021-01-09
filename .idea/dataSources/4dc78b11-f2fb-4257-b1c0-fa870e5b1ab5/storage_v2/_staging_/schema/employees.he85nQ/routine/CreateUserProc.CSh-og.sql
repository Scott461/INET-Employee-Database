create
    definer = root@`%` procedure CreateUserProc(IN user_name varchar(64), IN hash varchar(256))
BEGIN
    INSERT INTO web_users(user_name, hash) VALUES (user_name, hash);
END;
