import React from "react";
import { useState } from "react";
import axios from "axios";
import { useEffect } from "react";
import {  BrowserRouter ,Link,Router,  Routes,  Route ,Switch} from "react-router-dom";
import Candels from './Candels'
import  Search  from "./Search";
import Symbls from './Symbls'
import './App.css'
function FetchSearch()

    {
      
        var srch=[]
        
        var syb=" Symbol:"
       const a=[1,2,23,4]
        var c=-1
        const [desc,setDes]=useState([])
        const [symbl,setSym]=useState([])
        const [sen,setSend]=useState("")
        const [nam,setNam]=useState("Name:")
        const [search,setSerch]=useState("")
        var li=[]
        var lii=[]
        const [isOpen, setIsOpen] = useState(false);

  const toggleNavbar = () => {
    setIsOpen(!isOpen);
  };
        function fetch(e)
        {
          srch=e.target.value
          
        }
        
        function Inn()
        {
         setSerch("search")
       
        axios
                .get(`https://finnhub.io/api/v1/search?q=${srch}&token=cjmeg19r01qmdd9puljgcjmeg19r01qmdd9pulk0`)
        .then((response) =>
        {   var con=0
               const {count}= response.data
               while(con<count){
                
                const {description,symbol}= response.data.result[con]
               
                li.push(symbol)
                lii.push(description)
                setDes(lii)
                setSym(li)
                con=con+1
                setSend(a[2])
               }
                
        })
    }
    ;
    srch=symbl[0]
    JSON.stringify(srch)
    console.log(typeof(srch))
        return(<>
         <div className="App">
      <nav className="navbar">
        <div className="navbar-brand">
          <a href="/">PT</a>
        </div>
        <div className="navbar-menu">
          <div className="navbar-start">
            <a href="/home" className="navbar-item">
              Home
            </a>
            <a href="/symbols" className="navbar-item">
              Symbols
            </a>
        
          </div>
          
        </div>
      </nav>
    </div>

        <div class="searching">
        <input type="text" onChange={fetch}/>
        <button onClick={Inn}>SEARCH</button>
        </div>
       
      
        {
            
           desc.map((x)=>{
            c=c+1
            
             return <h1 id="long">{nam}{x}<br/> {syb}{symbl[c]}</h1>

           })
            
  
            }


<BrowserRouter>
<Link to="/search" onClick={(()=>{setDes([""], setNam(""),setSerch(""))})}>{search}</Link>
      <Routes>
      <Route path="symbols" element={<Symbls />} />
          <Route path="search" element={<Search x={symbl[0]}/>} />
          <Route path="candels" element={<Candels x={symbl[0]}/>} />
      </Routes>
    </BrowserRouter>
    <h1>{li}</h1>
       </>)
      
       
    }
    export default FetchSearch
    