## how to run:
- run docker environment, install dependency,  refresh db, insert fixtures
``` sh
    $ make up
    $ make composer-install
    $ make db-refresh
```

    
- [api docs](http://localhost:1337/api/doc)
- [postgres](http://localhost:3308)

**System**: PostgreSQL

**Server**: postgres

**Username**: postgres

**Password**: pgpassword

**Database**: app

## get user token for swagger:
```sh
curl -X POST -H "Content-Type: application/json" http://localhost:1337/api/login_check -d '{"username":"user@mail.com","password":"passwd"}'
```
>{"token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE1MzMxMTA5OTEsImV4cCI6MTUzMzExNDU5MSwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoidXNlciJ9.ee9MPai4xe5E_BkGiTdLxck35jweCncQjBgIw6WMrRC3hAgttz4XELAPGldSHF9NJoslqd8-EPeZ_E7oJCuqYHvSPlST1z-OvX86exlkGEMPE7o5_65QpPW_sTlfRl3snDK2nUSfpjeEZozUi2OQDaJ6GRwF_--WNEw5-yIYaNgxSF565kGKctqhGmWtP8nap70R9MpDyP81vgQ2Lo7mkhkOR7SK1IKsupjfMQlxHZCuxLH_U3KMoyaG_ODSKVEr_DP3m2z6tLud_CU8ruCSPUms1bYkqmKqltgygl6hzb_v2JhFVLLPHYLja1JaSA-PphH7nRxSih87dVhy0gASs3ByIsnI7hiIdF_JBpRevrX3z8vE2D9Pe8fbAFHEomnwNM5sE4zsoV38ROXgGIi_wJXKjypKw3ziIv__Cf3npE-pDmENuYNZTLRwrItfDdsDtyDZnhO4L773FMjz-1D4A-XIbsVP2gPrGuIpwcSnDkFK6uM8Bz42h-vodnHyhtiEGbzIknb8wprT29Jod_3S_jP7AQrrnPu0mmgH9bxVuthv3HX-n93j7GS-2x2UMkxV0EtECl0ym7yZGNX5TY9_BwmcDbW6knBnaPGscO0iGm75Z0GTdAePQOzjYKYYv6doksI_yybwq-qaDJPGizIX4X7i-UotarzH6Pwj0fJcSJo"}⏎
## get admin token for swagger:
```sh
curl -X POST -H "Content-Type: application/json" http://localhost:1337/api/login_check -d '{"username":"admin@mail.com","password":"passwd"}'
```
>{"token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE1MzMxMTExMjMsImV4cCI6MTUzMzExNDcyMywicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6ImFkbWluIn0.l-Mley8MJyYqTuFg3pD3-pS230fzlh3aYqXNUrJtmu3A0HiuAjknE8wRNzBZ_ZA7T_t3z-SuxDtgkYq_D0t3oepzxC8g8k5KQxuoxZxm0Md-pYf6aeOJkHPjU6er2BXBoN-sxucpGOMTcgxgpQ0zIQQ8Kcao6p-v-9UG0ngT6OM6oeOkemkKMeOg_qq3qtLFQf59K2l8udmRsWQvdlZ9Wxr22GNZ4Py38Zb-k4ZsDlJcmd_GnYdsEFvr-LtEcqvczCtCwlMdTnw34jm6OBqu8_6hIeX5WoEBQEnYs3pbx5L5ZueRy-riJFNwwWKp8AHRuPyRrM1ulRInoO2tDarvAukExsQwlnwJb6Y7mssWatTDeyN-lK0ADh3H1LuqrXhywbno2CjhkOlhOuJAOEXI76xPlElrhRsNT281W2kgU0-e4kk7WgF4jz3IcOX0S1WoV70MgkAurvdaRR4495IiFwmUvSFGfa9gwnSO_iGnG532ANhRVGbORp_GAJXswAWJjux1jOzoodWNhYvzvAt4YbfCYjjnyIkPYrZsYwx9q6gFp_fIXSJ-fm611y6ezJy6Kn5y_jmaszW9nj2lKqY6ZaGe9gb2J7YfQI0in5GaCStk3dSfcXrFzru3DPSEdM8krSRGeIgT3cz8o7Ikh-80CJQOdICYNcZQeHjiQ7pwqh4"}⏎    