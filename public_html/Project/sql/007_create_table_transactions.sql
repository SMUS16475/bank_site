CREATE TABLE IF NOT EXISTS Transactions(
    -- this will be like the bank project transactions table (pairs of transactions)
    id int AUTO_INCREMENT PRIMARY KEY ,
    account_src int,
    account_des int,
    bal_change int,
    trans_type varchar(15) not null COMMENT 'The type of transaction that occurred',
    exp_total int,
    memo varchar(240) default null COMMENT  'Any extra details to attach to the transaction',
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (account_src) REFERENCES Accounts(id),
    FOREIGN KEY(account_des) REFERENCES Accounts(id),
    constraint ZeroTransferNotAllowed CHECK(bal_change != 0)
)