# API MPFE 
##### version 1.0

## Installation 

### Clone project 
```
git clone http://10.1.1.70/PROTOTYPE/BackendPROTOTYPE.git

cd BackendPROTOTYPE
```
### Install dependencies via composer
```
composer install
```
### FTP parameters
```
/app/config/parameters_prototype.yml
```
### Run server
```
php bin/console server:run 8000

http://localhost:8000
```

### API Doc
```
http://localhost:8000/api/doc
```

### `Git branch naming`

```
bug    - Code changes linked to a known issue.
feat   - New feature.
hotfix - Quick fixes to the codebase.
junk   - Experiments (will never be merged).
```

#### `<name>`
Always use dashes to seperate words, and keep it short.

#### Examples
```
feat/satellite-module
hotfix/ftp-access
bug/login-ie
```

#### Les instruction pour faire un pull depuis le branch develop
```
git commit -m "commit 4 pull" / dans votre branch
git checkout develop
git pull origin develop
git checkout votre_branch
git rebase develop

// en cas de conflit correction du conflit puis
git add .
git rebase --continue
```