const express = require('express');
const app = express()
const path = require('path');
const axios = require('axios');

const port = 8000
const staticPath = (path.join(__dirname))


app.use(express.static(staticPath))

app.get('/', (req, res) => {
    res.sendFile('index.html',staticPath)
})

// app.get('/api', async(req, res) => {
//     let r = await axios.get("https://newsapi.org/v2/everything?q=bitcoin&apiKey=371ee12863ac44f3aa7fd2938f39c73a")

//     res.json(r);
// })

app.get('/api',async(req,res)=>{
  console.log(req._parsedUrl.query)
  let url = "https://newsapi.org/v2/everything?"+req._parsedUrl.query
  let r = await axios(url)
  let a= r.data
  res.json(a)
})

app.listen(port, () => {
  console.log(`app listening on port ${port}`)
})