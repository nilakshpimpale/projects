import React from "react";
import { useState } from "react";
import axios from "axios";
import { useEffect } from "react";
import {  BrowserRouter ,Link,Router,  Routes,  Route} from "react-router-dom";
import Candels from './Candels'
import  Search  from "./Search";
import Search1 from "./Search1"
import Symbls from "./Symbls"
import './App.css'
const FetchName = (prop) =>
    {

    var s=prop.x
    var x=1
    var y=[]
    const [name,Setname]=useState()
    const [lo,setlogo]=useState()
    const [exc,setexchange]=useState()
    const [url,seturl]=useState()
    const [phn,setphone]=useState()
    const [insdustry,setindusrty]=useState() 
    const [cp,currentp]=useState()
    const [symbl,cs]=useState(s)
  

    function FetchSearch()
    {
        
        axios
                .get(`https://finnhub.io/api/v1/stock/profile2?symbol=${symbl}&token=cjmeg19r01qmdd9puljgcjmeg19r01qmdd9pulk0`)
        .then((response) =>
        {
               const {name,logo,weburl,exchange,phone,finnhubIndustry}= response.data
                 Setname(name)
                 setlogo(logo)
                 setexchange(exchange)
                 setindusrty(finnhubIndustry)
                 setphone(phone)
                 seturl(weburl)
            
        })
        axios
        .get(`https://finnhub.io/api/v1/quote?symbol=${symbl}&token=cjmeg19r01qmdd9puljgcjmeg19r01qmdd9pulk0`)
.then((response) =>
{
       const {c}= response.data
             currentp("price: $ "+ c)
    
})

    
}
FetchSearch()
    return(<>
   


   
    <div class="center">
     <h1>{name}</h1>
     <img src={lo}/>
     <h2>{cp}</h2>
     <h2>{exc}</h2>
     <h2>{insdustry}</h2>
     <h2>{phn}</h2>
     <Link to="/candels">{name}</Link>
     </div>
     
    
     <Routes>
     <Route path="symbols" element={<Symbls />} />
          <Route path="search" element={<Search x={symbl[0]}/>} />
          <Route path="candels" element={<Candels x={symbl[0]}/>} />
          
      </Routes>
     
    
    </>)
}
  

export default FetchName
