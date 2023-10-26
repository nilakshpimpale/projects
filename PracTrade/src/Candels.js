
import React, { useEffect, useRef } from 'react';
import './App.css';
import {  BrowserRouter ,Link,Router,  Routes,  Route} from "react-router-dom";
import Search1 from './Search1'
import  Search  from "./Search";
import Symbls from './Symbls'
let tvScriptLoadingPromise;

 function TradingViewWidget(prop) {
    var symbol=prop.x
    
  const onLoadScriptRef = useRef();

  useEffect(
    () => {
      onLoadScriptRef.current = createWidget;

      if (!tvScriptLoadingPromise) {
        tvScriptLoadingPromise = new Promise((resolve) => {
          const script = document.createElement('script');
          script.id = 'tradingview-widget-loading-script';
          script.src = 'https://s3.tradingview.com/tv.js';
          script.type = 'text/javascript';
          script.onload = resolve;

          document.head.appendChild(script);
        });
      }

      tvScriptLoadingPromise.then(() => onLoadScriptRef.current && onLoadScriptRef.current());

      return () => onLoadScriptRef.current = null;

      function createWidget() {
        if (document.getElementById('tradingview_ff1c9') && 'TradingView' in window) {
          new window.TradingView.widget({
            autosize: true,
            symbol: "NASDAQ:"+symbol,
            interval: "D",
            timezone: "Etc/UTC",
            theme: "dark",
            style: "1",
            locale: "en",
            enable_publishing: false,
            allow_symbol_change: true,
            container_id: "tradingview_ff1c9"
          });
        }
      }
    },
    []
  );

  return (
    
    <div className='tradingview-widget-container' >
      <div id='tradingview_ff1c9'  />
      <a href="/home"><button>Home</button></a>
      <Routes>
          <Route path="home" element={<Search1 />} />
          <Route path="search" element={<Search/>} />
          <Route path="symbols" element={<Symbls />} />
          
      </Routes>
    </div>
  );
}
export default TradingViewWidget