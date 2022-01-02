# Project Name: Simple Bank
## Project Summary: This project will create a bank simulation for users. They’ll be able to have various accounts, do standard bank functions like deposit, withdraw, internal (user’s accounts)/external(other user’s accounts) transfers, and creating/closing accounts.
## Github Link: (Prod Branch of Project Folder)
## Project Board Link: https://github.com/EmmanuelChiobi/IT202-007/projects/1
## Website Link: https://ec362-prod.herokuapp.com/Project/login.php
## Your Name: Emmanuel Chiobi

<!--
### Line item / Feature template (use this for each bullet point)
#### Don't delete this

- [ ] \(mm/dd/yyyy of completion) Feature Title (from the proposal bullet point, if it's a sub-point indent it properly)
  -  List of Evidence of Feature Completion
    - Status: Pending (Completed, Partially working, Incomplete, Pending)
    - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
    - Pull Requests
      - PR link #1 (repeat as necessary)
    - Screenshots
      - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
        - Screenshot #1 description explaining what you're trying to show
### End Line item / Feature Template
--> 
### Proposal Checklist and Evidence

- Milestone 1
  - [ ] Users will be able to register a new account
    - Form Fields
      - [ ] Username, email, password, confirm password (other fields optional)
      - [ ] Email is required and must be validated
      - [ ] Username is required
      - [ ] Confirm password's match
    - User Table
      - [ ] Id, username, email, password (60 characters), created, modified
    - Password must be hashed (plain text passwords will lose points)
    - Email should be unique
    - Username should be unique
    - System should let user know if username or email is taken and allow the user to correct the error without wiping/clearing the form.
      - [ ] The only fields that may be cleared are the password fields
  - [ ] User will be able to login to their account (given they enter the correct credentials)
    - Form
      - [ ] User can login with email or username
        - This can be done as a single field or as two separate fields
      - [ ] Password is required
    - User should see friendly error messages when an account either doesn't exist or if passwords don't match
    - Logging in should fetch the user's details (and roles) and save them into the sessions
    - User will be directed to a landing page upon login
      - [ ] This is a protected page (non-logged in users shouldn't have access)
  - User will be able to logout
    - Logging out will redirect to login page
    - User should see a message that they've successfully logged out
    - Session should be destroyed (so the back button doesn't allow them access back in)
  - [ ] Basic security rules implemented
    - Authentication:
      - [ ] Function to check if user is logged in
      - [ ] Function should be called on appropriate pages that only allow logged in users
    - Roles/Authorization:
      - [ ] Have a roles table (see below)
  - [ ] Basic Roles implemented
    - Have a Roles table (id, name, description, is_active, modified, created)
    - Have a User Roles table (id, user_id, role_id, is_active, created, modified)
    - Include a function to check if a user has a specific role (we won't use it for this milestone but it should be usable in the future)   
  - [ ] Site should have basic styles/theme applied; everything should be styled
    - I.e., forms/input, navigation bar, etc.
  - [ ] Any output messages/errors should be "user friendly"
    - Any technical errors or debug output displayed will result in a loss of points
  - [ ] User will be able to see their profile
    - Email, username, etc.
  - [ ] User will be able to edit their profile
    - Changing username/email should properly check to see if it's available before allowing the change
    - Any other fields should be properly validated
    - Allow password reset (only if the existing correct password is provided)
      - [ ] Hint: logic for the password check would be similar to login.
- Milestone 2
  - [x] (12/20/2021) Create the Accounts table (id, account_number, [unique, always 12 characters], user_id, balance (default 0), account_type, created, modified)
    - List of Evidence of Feature Completion
      - Status: Completed
      - Direct Link: N/A
      - Pull Request: https://github.com/EmmanuelChiobi/IT202-007/pull/46
      - Screenshots:
        - Screenshot #1 (SQL code): ![image](https://user-images.githubusercontent.com/90267631/146817655-37d4287b-cf8f-4341-af93-e6006970b4dc.png)
        - Screenshot #2 (Evidence of Accounts table created): ![image](https://user-images.githubusercontent.com/90267631/146817700-8aae3421-d0c1-4c11-8967-6c22fb18db33.png)
  - [x] (12/20/2021) Project setup steps:
    - List of Evidence of Feature Completion
      - Status: Completed
      - Direct Link: N/A
      - Pull Request: https://github.com/EmmanuelChiobi/IT202-007/pull/46
      - Screenshots:
        - Screenshot #1 (SQL code of system user): ![image](https://user-images.githubusercontent.com/90267631/146818143-83809b11-32e9-45f7-a909-692479e57d5a.png)
        - Screenshot #2 (SQL code of world account): ![image](https://user-images.githubusercontent.com/90267631/146818051-7196a958-d581-4a16-bc60-c3080f7bba12.png)
        - Screenshot #3 (Evidence of system user and components): ![image](https://user-images.githubusercontent.com/90267631/146818310-8468dfc6-d484-49e3-b069-727a26103588.png)
        - Screenshot #4 (Evidence of world account and components): ![image](https://user-images.githubusercontent.com/90267631/146818414-4c0c93a3-24b8-4289-b965-fcd71c1c1f69.png)
  - [x] (12/20/2021) Create the Transactions table
    - List of Evidence of Feature Completion:
      - Status: Completed
      - Direct Link: N/A
      - Pull Request: https://github.com/EmmanuelChiobi/IT202-007/pull/46
      - Screenshots:
        - Screenshot #1 (SQL code of Transactions table): ![image](https://user-images.githubusercontent.com/90267631/146819137-b03fec71-e89b-471e-8540-ff9cab073192.png)
        - Screenshot #2 (Evidence of Transaction table created): ![image](https://user-images.githubusercontent.com/90267631/146819265-1b993d33-c4d0-4779-9a7d-24582e5b06f4.png)
  - [x] (12/19/21) Dashboard page
    - List of Evidence of Feature Completion:
      - Status: Completed
      - Direct Link: https://ec362-prod.herokuapp.com/Project/dashboard.php
      - Pull Request: https://github.com/EmmanuelChiobi/IT202-007/pull/46
      - Screenshots:
        - Screenshot #1 (PHP code of Dashboard page): ![image](https://user-images.githubusercontent.com/90267631/146823514-1eb941d4-e397-47de-884d-af261f0ff371.png)
        - Screenshot #2 (Dashboard page): ![image](https://user-images.githubusercontent.com/90267631/146819510-1584fa4d-05a0-44b7-b442-e61f6b80ebba.png)
  - [x] (12/18/21) User will be able to create a checking account
    - List of Evidence of Feature Completion:
      - Status: Completed
      - Direct Link: https://ec362-prod.herokuapp.com/Project/create_account.php
      - Pull Request: https://github.com/EmmanuelChiobi/IT202-007/pull/46
      - Screenshots: 
        - Screenshot #1 (Create Account page): ![image](https://user-images.githubusercontent.com/90267631/146819841-826a7d8a-aff7-4971-b3d2-fe2e4c1f48fc.png)
        - Screenshot #2 (Account creation successful): ![image](https://user-images.githubusercontent.com/90267631/146820143-d2f43a47-9e39-4a88-a651-ccae2ef5e4a2.png)
        - Screenshot #3 (Evidence of created account in Accounts table / Account associated to user / Randomly generated 12-digit account number): ![image](https://user-images.githubusercontent.com/90267631/146820628-1f1b2b36-b527-47b4-b1c2-68bf2397f02c.png)
        - Screenshot #4 (Minimum deposit is $5): ![image](https://user-images.githubusercontent.com/90267631/146820718-e5eb085b-4118-4d00-aeb0-54673432c2e8.png)
  - [x] (12/19/21) User will be able to list their accounts
    - List of Evidence of Feature Completion:
      - Status: Completed
      - Direct Link: https://ec362-prod.herokuapp.com/Project/view_accounts.php
      - Pull Request: https://github.com/EmmanuelChiobi/IT202-007/pull/46
      - Screenshots:
        - Screenshot #1 (PHP code showing 5 account limit): ![image](https://user-images.githubusercontent.com/90267631/146821324-7890da8b-8a9c-4e3c-9e1d-f3c7d49b9635.png)
        - Screenshot #2 (Accounts page): ![image](https://user-images.githubusercontent.com/90267631/146821571-3fff11e7-4703-4824-9d6d-e4781f48c99f.png)
  - [x] (12/20/21) User will be able to click an account for more information (a.k.a. Transaction History page)
    - List of Evidence of Feature Completion:
      - Status: Completed
      - Direct Link (this is the transaction history for the account with an id of "29"): https://ec362-prod.herokuapp.com/Project/transactions_page.php?id=29
      - Pull Request: https://github.com/EmmanuelChiobi/IT202-007/pull/46
      - Screenshots:
        - Screenshot #1 (Transaction history page): ![image](https://user-images.githubusercontent.com/90267631/146821996-a3017cb3-bc5a-48be-9c32-b5c2d6337d42.png)
        - Screenshot #2 (Comparison to Transactions table): ![image](https://user-images.githubusercontent.com/90267631/146822445-e4dea00d-52d8-4769-a898-6bb28d657c63.png)
        - Screenshot #3 (PHP code showing 10 transaction limit): ![image](https://user-images.githubusercontent.com/90267631/146822739-7cbef261-f3bb-4e4f-8923-d0d8c083fcdc.png)
  - [x] (12/19/21) User will be able to deposit/withdraw from their account(s)
    - List of Evidence of Feature Completion:
      - Status: Completed
      - Direct Link: https://ec362-prod.herokuapp.com/Project/new_transaction.php
      - Pull Request: https://github.com/EmmanuelChiobi/IT202-007/pull/46
      - Screenshots:
        - Screenshot #1 (Transaction page): ![image](https://user-images.githubusercontent.com/90267631/146824564-3dbf4ddc-551d-4d50-b09c-9e1bb23d8308.png)
        - Screenshot #2 (Evidence of successful transaction): ![image](https://user-images.githubusercontent.com/90267631/146824793-fe23bb01-d941-4ca4-b28b-2d94afa42985.png)
        - Screenshot #3 (Evidence of transaction in Transaction table): ![image](https://user-images.githubusercontent.com/90267631/146824984-34240117-ba12-4d6f-97f8-a2a2e9930615.png)
- Milestone 3
  - [x] (12/20/21) User will be able to transfer between their accounts
    - List of Evidence of Feature Completion:
      - Status: Completed
      - Direct Link: https://ec362-prod.herokuapp.com/Project/transfer.php
      - Pull Request: https://github.com/EmmanuelChiobi/IT202-007/pull/54
      - Screenshots:
        - Screenshot #1 (Transfer page): ![image](https://user-images.githubusercontent.com/90267631/147040510-38d26512-e2e1-4f54-8364-df8cb7201e3d.png)
        - Screenshot #2 (Evidence of successful transfer): ![image](https://user-images.githubusercontent.com/90267631/147040551-2eefd25e-5449-43c6-a5e9-e99e36f55868.png)
        - Screenshot #3 (Evidence of transfer in Transaction table): ![image](https://user-images.githubusercontent.com/90267631/147040686-86fb8507-de0e-4307-909e-7e749a4cc2c2.png)
  - [x] (12/21/21) Transaction History page
    - List of Evidence of Feature Completion:
      - Status: Completed
      - Direct Link (this is the transaction history of an account with the id of "33"): https://ec362-prod.herokuapp.com/Project/transactions_page.php?id=33
      - Pull Request: https://github.com/EmmanuelChiobi/IT202-007/pull/54
      - Screenshots:
        - Screenshot #1 (All transactions present): ![image](https://user-images.githubusercontent.com/90267631/147040895-3a9af3fc-fac9-4d52-b7e2-78e6175bec9f.png)
        - Screenshot #2 (Transactions filtered by transaction type "deposit"): ![image](https://user-images.githubusercontent.com/90267631/147040960-b7f84efe-ef88-4e80-86be-4364a1bf2762.png)
        - Screenshot #3 (Transactions filtered by transaction type "withdraw"): ![image](https://user-images.githubusercontent.com/90267631/147041015-a4fee753-b56d-4980-944a-e7e71cb59ae3.png)
        - Screenshot #4 (Transactions filtered by transaction type "transfer"): ![image](https://user-images.githubusercontent.com/90267631/147041102-e687900c-7fac-4c64-945a-838abccc6184.png)
  - [x] (12/21/21) User's profile page should record/show first and last name.
    - List of Evidence of Feature Completion:
      - Status: Completed
      - Direct Link: https://ec362-prod.herokuapp.com/Project/profile.php
      - Pull Request: https://github.com/EmmanuelChiobi/IT202-007/pull/54
      - Screenshots: 
        - Screenshot #1 (First & last name present in profile page): ![image](https://user-images.githubusercontent.com/90267631/147041270-2c21ffd9-6cdd-4b3f-9090-c484d5c1844e.png)
        - Screenshot #2 (First & last name present in Users table): ![image](https://user-images.githubusercontent.com/90267631/147041379-65161222-a267-4432-804c-00ed09438483.png)
        - Screenshot #3 (First & last name changed / Successful change of first & last name): ![image](https://user-images.githubusercontent.com/90267631/147041505-f9f93ff3-64dd-4ddc-bba4-f12c6736c78d.png)
        - Screenshot #4 (Evidence of successful change in Users table): ![image](https://user-images.githubusercontent.com/90267631/147041579-c719d8a3-093b-4536-85e1-63129ccfd8cb.png)
  - [x] (12/21/21) User will be able to transfer funds to another user's account
    - List of Evidence of Feature Completion:
      - Status: Completed
      - Direct Links:
        - Direct Link #1 (Choice between internal and external transfer): https://ec362-prod.herokuapp.com/Project/transfer_dash.php
        - Direct Link #2 (External transfer page): https://ec362-prod.herokuapp.com/Project/outer_transfer.php
      - Pull Request: https://github.com/EmmanuelChiobi/IT202-007/pull/54
      - Screenshots:
        - Screenshot #1 (Option to choose internal or external transfer): ![image](https://user-images.githubusercontent.com/90267631/147043960-6a2fd4ba-b2f2-422d-8dba-82d99bb7452b.png)
        - Screenshot #2 (External transfer page): ![image](https://user-images.githubusercontent.com/90267631/147044355-47e269ed-8f1b-4018-8c22-b4817f10d3d8.png)
        - Screenshot #3 (Evidence of successful external transfer): ![image](https://user-images.githubusercontent.com/90267631/147044737-92c6fd36-2a08-4fd3-b943-927dcb3b8281.png)
        - Screenshot #4 (Evidence of transfer in Transaction table): ![image](https://user-images.githubusercontent.com/90267631/147045318-f39ce94b-43cc-45a1-96a3-271414425898.png)
- Milestone 4
  - [x] (12/22/21) User can set their profile to be public or private (will need another column in Users table)
    - List of Evidence of Feature Completion:
      - Status: Completed
      - Direct Link: https://ec362-prod.herokuapp.com/Project/profile.php
      - Pull Request: https://github.com/EmmanuelChiobi/IT202-007/pull/69
      - Screenshots:
        - Screenshot #1 (Profile page): ![image](https://user-images.githubusercontent.com/90267631/147195660-cb2040de-9359-46a3-b286-777d6877b75a.png)
        - Screenshot #2 (Evidence of user profile made public in Users table): ![image](https://user-images.githubusercontent.com/90267631/147195785-6a51e943-8e57-4221-b123-b1cfa02f756e.png)
  - [x] (12/22/21) User will be able to open a savings account
    - List of Evidence of Feature Completion:
      - Status: Completed
      - Direct Links: 
        - Direct Link #1 (Create account page): https://ec362-prod.herokuapp.com/Project/create_account.php
      - Pull Request: https://github.com/EmmanuelChiobi/IT202-007/pull/69
      - Screenshots:
        - Screenshot #1 (Creating a savings account): ![image](https://user-images.githubusercontent.com/90267631/147195968-806c307c-86e4-4d32-a6e3-3841120217c8.png)
        - Screenshot #2 (Evidence of successful savings account creation): ![image](https://user-images.githubusercontent.com/90267631/147196056-f98dffbb-35c1-49cb-83e4-2601c2ff1f5f.png) ![image](https://user-images.githubusercontent.com/90267631/147196122-e583f917-af31-4faa-9191-d2587a4a435a.png)
        - Screenshot #3 (Evidence of savings account in Accounts table / APY set in savings account): ![image](https://user-images.githubusercontent.com/90267631/147196210-cc671d3a-d7e3-4794-98bc-f123b88c1240.png)
        - Screenshot #4 (Evidence of minimum deposit transaction): ![image](https://user-images.githubusercontent.com/90267631/147196269-76c49994-5554-4841-ac99-2805dc0bd6b2.png)
  - [x] (12/22/21) User will be able to take a loan.
    - List of Evidence of Feature Completion:
      - Status: Completed
      - Direct Links:
        - Direct Link #1 (Created account page): https://ec362-prod.herokuapp.com/Project/create_account.php
      - Pull Request: https://github.com/EmmanuelChiobi/IT202-007/pull/69
      - Screenshots:
        - Screenshot #1 (Creating a loan account): ![image](https://user-images.githubusercontent.com/90267631/147196616-7f5f89b3-cc29-4180-bfa9-0f95d4db468b.png) ![image](https://user-images.githubusercontent.com/90267631/147196850-fec2b117-b2c8-4a2c-8636-8bf5f7dd0d1d.png)
        - Screenshot #2 (Evidence of successful loan account created): ![image](https://user-images.githubusercontent.com/90267631/147196947-11b8f64b-10a8-430a-b0dd-ee641a519c54.png)
        - Screenshot #3 (Evidence of loan account in Accounts table / APY set in loan account): ![image](https://user-images.githubusercontent.com/90267631/147197028-120e94a3-8759-4f86-aa2c-33ffe3a04a43.png)
        - Screenshot #4 (Evidence of minimum deposit transaction): ![image](https://user-images.githubusercontent.com/90267631/147197090-411e3cf3-4551-4615-b4b5-8987746dc6ed.png)
        - Screenshot #5 (Evidence of loan account not present in dropdown): ![image](https://user-images.githubusercontent.com/90267631/147197252-221682a4-71bd-4937-a686-23bea09db9b5.png)
  - [x] (12/22/21) Listing accounts and/or viewing Account Details should show any applicable APY or "-" if none is set for the particular account (may alternatively just hide the display for these types)
     - List of Evidence of Feature Completion:
      - Status: Completed
      - Direct Links:
      - Pull Request: https://github.com/EmmanuelChiobi/IT202-007/pull/69
        - Direct Link #1 (Created account page): https://ec362-prod.herokuapp.com/Project/view_accounts.php
      - Screenshot (Checking accounts only have "-" as their APY values): ![image](https://user-images.githubusercontent.com/90267631/147198297-5f5d1dbf-ffca-4790-beb6-cf000d53d6c1.png)
  - [x] (12/22/21) User will be able to close an account
     - List of Evidence of Feature Completion:
      - Status: Completed
      - Direct Links:
        - Direct Link #1 (Transactions page): https://ec362-prod.herokuapp.com/Project/transactions_page.php
      - Screenshots: 
        - Screenshot #1 (Close account option in Transactions page): ![image](https://user-images.githubusercontent.com/90267631/147198764-511478a6-6005-4e41-9987-2d373705bb34.png)
        - Screenshot #2 (Asking if the user is sure about their choice / Close account page for the account with an id of "34"): ![image](https://user-images.githubusercontent.com/90267631/147198894-50c00274-68bc-4d73-81bd-ac1ad43bda23.png)
        - Screenshot #3 (Account still has funds): ![image](https://user-images.githubusercontent.com/90267631/147198965-316e03c5-fa8b-4012-a933-aec51269803c.png)
        - Screenshot #4 (Evidence of successful account closure): ![image](https://user-images.githubusercontent.com/90267631/147199111-50586d20-7325-40f5-8d3d-7ded304785fb.png) ![image](https://user-images.githubusercontent.com/90267631/147199343-7baec3f9-c6cf-4548-88af-0737c9cd0d04.png)
        - Screenshot #5 (Evidence of account closure in Accounts table): ![image](https://user-images.githubusercontent.com/90267631/147199453-24ad3daa-ce7b-42ac-ab3f-5ce7c3b46832.png)
  - [ ] Admin role
    - List of Evidence of Feature Completion:
      - Status: Incomplete
      - Direct Link: N/A
      - Pull Requests: N/A
      - Screenshots:
        - Screenshot #1 (Evidence of search_users PHP code): 
        - Screenshot #2 (Evidence of search_users in navigation bar): 
      - Explanation: Throughout the entire time I was working on Milestones 1 - 4, I was consistently confused about everything I was doing. Eventually, every other feature was completed, and the entire project as a whole was nearing completion, but I realized so much time went by, and I still had a lot to do (Admin Roles). Ultimately, I decided not to do it. However, there is one component that I got partially written during the time, "search_users". Considering what else was presented here in the project, it did not seem worth the time.
### Instructions
#### Don't delete this
1. Pick one project type
2. Create a proposal.md file in the root of your project directory of your GitHub repository
3. Copy the contents of the Google Doc into this readme file
4. Convert the list items to markdown checkboxes (apply any other markdown for organizational purposes)
5. Create a new Project Board on GitHub
   - Choose the Automated Kanban Board Template
   - For each major line item (or sub line item if applicable) create a GitHub issue
   - The title should be the line item text
   - The first comment should be the acceptance criteria (i.e., what you need to accomplish for it to be "complete")
   - Leave these in "to do" status until you start working on them
   - Assign each issue to your Project Board (the right-side panel)
   - Assign each issue to yourself (the right-side panel)
6. As you work
  1. As you work on features, create separate branches for the code in the style of Feature-ShortDescription (using the Milestone branch as the source)
  2. Add, commit, push the related file changes to this branch
  3. Add evidence to the PR (Feat to Milestone) conversation view comments showing the feature being implemented
     - Screenshot(s) of the site view (make sure they clearly show the feature)
     - Screenshot of the database data if applicable
     - Describe each screenshot to specify exactly what's being shown
     - A code snippet screenshot or reference via GitHub markdown may be used as an alternative for evidence that can't be captured on the screen
  4. Update the checklist of the proposal.md file for each feature this is completing (ideally should be 1 branch/pull request per feature, but some cases may have multiple)
    - Basically add an x to the checkbox markdown along with a date after
      - (i.e.,   - [x] (mm/dd/yy) ....) See Template above
    - Add the pull request link as a new indented line for each line item being completed
    - Attach any related issue items on the right-side panel
  5. Merge the Feature Branch into your Milestone branch (this should close the pull request and the attached issues)
    - Merge the Milestone branch into dev, then dev into prod as needed
    - Last two steps are mostly for getting it to prod for delivery of the assignment 
  7. If the attached issues don't close wait until the next step
  8. Merge the updated dev branch into your production branch via a pull request
  9. Close any related issues that didn't auto close
    - You can edit the dropdown on the issue or drag/drop it to the proper column on the project board