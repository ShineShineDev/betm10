### Get Section

- `End Point : api/thaid/sections/latest`

- `Method : get`

- `Headers  Value  `

  -  `Authorization : Bearer TOKEN_HERE` 
  -  `Content-Type :  application/json`
  -  `Accept : application/json`

  ```json
  {
      "data": {
          "id": 2,
          "ticket_amount": 7000,
          "opening_date": "Tue, 12 Dec 23",
          "day": "12",
          "hours": "16",
          "minute": "15",
          "second": "00"
      }
  }
  ```



### Bet

- `End Point : api/thaid/sections/bet`

- `Method : post`

- `Headers  Value  `

  -  `Authorization : Bearer TOKEN_HERE` 
  -  `Content-Type :  application/json`
  -  `Accept : application/json`

- `body`

  - `bet_logs : required,array`

  ```json
  //Example Request
  {
      "bet_logs": [
          "123456",
          "654321"
      ]
  }
  
  //Success Response
  {
      "data": {
          "id": 6,
          "slip_number": "96#65785327ea738",
          "customer_id": 96,
          "total_amount": 7000,
          "thai_section_id": 2,
          "bet_date": "2023-12-12T12:33:43.960849Z"
      }
  }
  ```
  



### Bet History

- `End Point : api/thaid/sections/bet/history`

- `Method : post`

- `Headers  Value  `

  -  `Authorization : Bearer TOKEN_HERE` 
  -  `Content-Type :  application/json`
  -  `Accept : application/json`

  ```json
  {
      "data": [
          {
              "id": 7,
              "slip_number": "96#65785891d880e",
              "total_amount": 14000,
              "bet_date": "December 12 2023",
              "is_reject": "Active",
              "section": {
                  "id": 2,
                  "opening_date": "2023-12-16",
                  "opening_time": "16:15",
                  "closing_time": "16:00",
                  "bet_amount": 7000
              },
              "betting_logs": [
                  {
                      "id": 7,
                      "bet_number": "123123",
                      "reward_amount": "",
                      "rewrad_status": 0
                  },
                  {
                      "id": 8,
                      "bet_number": "123892",
                      "reward_amount": "",
                      "rewrad_status": 0
                  }
              ]
          },
          ...
      ]
  }
  ```

  
