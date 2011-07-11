function initDOM() {
	var c=window.location.pathname;
	ie6_test();
	if(document.getElementById("howimg")!=null) {
		how_demoAuction("auto")
	}
	if(document.getElementById("confirmed")!=null) {
		updating_confirmed_first()
	}
	if(document.getElementById("bar_tab")!=null) {
		if(c.indexOf("/live")!=-1) {
			if(document.getElementById("tab_live")!=null) {
				document.getElementById("tab_live").getElementsByTagName("span")[0].className+=" opacity1"
			}
		} else {
			if(c.indexOf("/closed")!=-1) {
				if(document.getElementById("tab_closed")!=null) {
					document.getElementById("tab_closed").getElementsByTagName("span")[0].className+=" opacity1"
				}
			} else {
				if(c.indexOf("/future")!=-1) {
					if(document.getElementById("tab_future")!=null) {
						document.getElementById("tab_future").getElementsByTagName("span")[0].className+=" opacity1"
					}
				} else {
					if(c.indexOf("/easy")!=-1) {
						if(document.getElementById("tab_easy")!=null) {
							document.getElementById("tab_easy").getElementsByTagName("span")[0].className+=" opacity1"
						}
					} else {
						if(c.indexOf("/rookieplus")!=-1) {
							if(document.getElementById("tab_rookieplus")!=null) {
								document.getElementById("tab_rookieplus").getElementsByTagName("span")[0].className+=" opacity1"
							}
						} else {
							if(c.indexOf("/rookie")!=-1) {
								if(document.getElementById("tab_rookie")!=null) {
									document.getElementById("tab_rookie").getElementsByTagName("span")[0].className+=" opacity1"
								}
							} else {
								if(document.getElementById("tab_home")!=null) {
									document.getElementById("tab_home").getElementsByTagName("span")[0].className+=" opacity1"
								}
							}
						}
					}
				}
			}
		}
	}
	if(navigator.userAgent.indexOf("AOL")!=-1) {
		prompt_showPage("pg_prompt_aol")
	}
	if((c.indexOf("/live/")!=-1)||(c.indexOf("/easy/")!=-1)) {
		auction_highlight(0);
		auction_rookies()
	}
	if(document.getElementById("mymad")!=null) {
		var a=document.getElementById("nav").getElementsByTagName("li");
		var b=a.length;
		for(var d=0;d<b;d++) {
			if(a[d].getElementsByTagName("a")[0].href.indexOf(c)!=-1) {
				a[d].className="selected"
			} else {
				a[d].className="unselected"
			}
		}
	}
	if(document.getElementById("sorting_btn")!=null) {
		document.getElementById("sorting_btn").onclick= function() {
			var l=document.getElementById("sorting").getElementsByTagName("input");
			var f=l.length;
			var j=[],k=[],h=[];
			for(var g=0;g<auctionIDs.length;g++) {
				j[g]= {
					id:auctionIDs[g],
					level:auctionLevels[g]+1,
					price:parseFloat(HTMLToNumber(auctionHighestBids[g]))
				}
			}
			for(var g=0;g<f;g++) {
				if((l[g].checked)&&(l[g].value>0)) {
					if(l[g].name=="price") {
						j.sort( function(m,i) {
							if(l[g].value==1) {
								return i.price-m.price
							}
							if(l[g].value==2) {
								return m.price-i.price
							}
						})
					}
					if(l[g].name=="level") {
						j.sort( function(n,m) {
							for(var i=0;i<4;i++) {
								k[i]=4-i
							}
							k=rotate_array(k,l[g].value-1);
							return k[m.level-1]-k[n.level-1]
						})
					}
				}
			}
			for(var e in j) {
				h.push(j[e].id)
			}
			if(h.length>0) {
				auction_resortArray(h)
			}
		}
	}
}

function auction_resortArray(d) {
	if(d.length==auctionIDs.length) {
		var c="";
		var b;
		for(var a in d) {
			b=document.getElementById("auction_"+d[a]);
			if(b!=null) {
				c+="<li id='auction_"+d[a]+"' class='"+b.className+"'>"+b.innerHTML+"</li>"
			}
		}
		document.getElementById("bidsys_auction_list").innerHTML=c
	}
}

function rotate_array(b,e) {
	for(var c=b.length,e=(Math.abs(e)>=c&&(e%=c),e<0&&(e+=c),e),d,a;e;e=(Math.ceil(c/e)-1)*e-c+(c=e)) {
		for(d=c;d>e;a=b[--d],b[d]=b[d-e],b[d-e]=a) {
		}
	}
	return b
}

function shake_element(b) {
	var c=12;
	var f=2;
	var e=document.getElementById(b);
	if(e!=null) {
		e.style.position="relative";
		var d=0;
		var a=f;
		window.setInterval( function() {
			if(d<=c) {
				a=f-a;
				d++;
				e.style.left=a+"px"
			}
		},50)
	}
}

function Referform(b,d) {
	var e=document.getElementById("refer_details").getElementsByTagName("fieldset")[0];
	var a=e.getElementsByTagName("input")[0].value;
	var c=1;
	e.getElementsByTagName("input")[0].onfocus= function() {
		this.value=""
	};
	e.getElementsByTagName("small")[0].onclick= function() {
		refer.add()
	};
	this.add= function() {
		var f=e.getElementsByTagName("p")[0].cloneNode(true);
		f.getElementsByTagName("small")[0].style.display="none";
		f.getElementsByTagName("small")[1].style.display="inline-block";
		f.getElementsByTagName("small")[1].onclick= function() {
			refer.remove(this)
		};
		e.appendChild(f);
		e.getElementsByTagName("input")[0].value=a;
		e.getElementsByTagName("input")[0].id="refer_email_"+c;
		c++;
		this.calculator()
	};
	this.remove= function(f) {
		e.removeChild(f.parentNode);
		this.calculator()
	};
	this.calculator= function() {
		var f=e.getElementsByTagName("input").length-1;
		e.getElementsByTagName("strong")[0].innerHTML=f*b;
		e.getElementsByTagName("strong")[1].innerHTML=f*d;
		e.getElementsByTagName("strong")[2].innerHTML=(f*b)+(f*d)
	}
}

function updating_confirmed_first() {
	if(document.getElementById("auction_"+auctionIDs[0])!=null) {
		document.getElementById("auction_"+auctionIDs[0]).className="auction n1";
		document.getElementById("tActionBid_"+auctionIDs[0]).className="button"
	}
	if(document.getElementById("auction_"+auctionIDs[1])!=null) {
		document.getElementById("auction_"+auctionIDs[1]).className="auction n2";
		document.getElementById("tActionBid_"+auctionIDs[1]).className="button c_gray"
	}
	if(document.getElementById("auction_"+auctionIDs[2])!=null) {
		document.getElementById("auction_"+auctionIDs[2]).className="auction n2";
		document.getElementById("tActionBid_"+auctionIDs[2]).className="button c_gray"
	}
	var a=document.getElementById("bidsys_auction_list").getElementsByTagName("li");
	var b=a.length;
	var f="";
	var e=0;
	if((a!=null)&&(b>1)) {
		for(var d=0;d<b;d++) {
			if(a[d].getElementsByTagName("a")[2]!=null) {
				e=HTMLToNumber(a[d].getElementsByTagName("a")[2].className)
			}
			if(e>0) {
				for(var c=0;c<e;c++) {
					f+='<small class="icon_bid"></small>'
				}
				a[d].getElementsByTagName("p")[0].innerHTML=f
			}
			f=""
		}
	}
}

function auction_rookies() {
	var c=document.getElementsByTagName("li");
	var a=c.length;
	for(var b=0;b<a;b++) {
		if(c[b].id.indexOf("auction")!=-1) {
			if(c[b].innerHTML.indexOf("flag_rookie")>0) {
				c[b].className+=" border_rookie"
			} else {
				c[b].className=c[b].className.replace("border_rookie","")
			}
		}
	}
}

function auction_highlight(g) {
	var e;
	var f="";
	if(document.cookie.indexOf(cookiePrefix+"_auction_highlights=")!=-1) {
		f=document.cookie.split(cookiePrefix+"_auction_highlights=")[1].split(";")[0]
	}
	if(g==0) {
		if(f!="") {
			var d=f.split(",");
			var a=d.length;
			for(var c=0;c<a;c++) {
				e=document.getElementById("auction_"+d[c]);
				if(e!=null) {
					e.className+=" border_color"
				}
			}
		}
	} else {
		e=document.getElementById("auction_"+g);
		if(e!=null) {
			e.className+=" border_color";
			if(f.indexOf(g)==-1) {
				var b=new Date();
				b.setTime(b.getTime()+(7*24*60*60*1000));
				f+=g+",";
				document.cookie=cookiePrefix+"_auction_highlights="+f+";expires="+b.toGMTString()+"; path=/"
			}
		}
	}
}

function cookieUser() {
	if(document.cookie.indexOf(cookiePrefix+"bidsys_user=")!=-1) {
		return document.cookie.split(cookiePrefix+"bidsys_user=")[1].split(";")[0]
	} else {
		return false
	}
}

function createUserLinks() {
	if(cookieUser()) {
		if(document.getElementsByTagName("var")!=null) {
			var c=document.getElementsByTagName("var");
			var b=c.length;
			var a;
			var f;
			var g;
			var e;
			for(var d=0;d<b;d++) {
				a=c[d].innerHTML;
				g=c[d].id.replace("i_","");
				if(document.getElementById("auction_bidding_history_"+auctionIDs[0])!=null) {
					f=HTMLToNumber(document.getElementById("tCurBid_"+auctionIDs[0]).innerHTML);
					if(d==0) {
						e="tCurBidder_"+g
					} else {
						e="lastbidder_"+(f*100-d)
					}
				} else {
					f=HTMLToNumber(document.getElementById("tCurBid_"+g).innerHTML);
					e="tCurBidder_"+g
				}
				if((isNaN(f))||(f!=0)) {
					c[d].innerHTML='<a id="'+e+'" onclick=pageTracker._trackEvent("username",window.location.pathname,"'+a+'") href=javascript:notification_show("'+e+'",7,"'+a+'")>'+a+'</a><small class="sneak_over_user"></small>'
				}
			}
		}
	}
}

function register_tooltip(a,b) {
}

function showLoginSection() {
	var a=document.getElementById("madbid_login_bar");
	if(a!=null) {
		a.style.display="block";
		a=document.getElementById("user_name_top");
		if(a!=null) {
			a.focus()
		}
	}
}

function hideLoginSection() {
	var a=document.getElementById("madbid_login_bar");
	if(a!=null) {
		a.style.display="none"
	}
}

function HTMLToNumber(c) {
	var b=new String(c);
	var d=b.replace(/[^0-9.,]/g,"");
	if(d.length>=3) {
		var a=d.charAt(d.length-3);
		if((a==".")||(a==",")) {
			d=d.replace(a,"DECIMAL");
			d=d.replace(".","");
			d=d.replace(",","");
			d=d.replace("DECIMAL",".")
		} else {
			d=d.replace(".","");
			d=d.replace(",","")
		}
	}
	return new Number(parseFloat(d))
}

function urlencode(a) {
	a=escape(a);
	a=a.replace("+","%2B");
	a=a.replace("@","%40");
	a=a.replace("/","%2F");
	a=a.replace("*","%2A");
	a=a.replace("%20","+");
	return a
}

var timeOn;
var dynamic_time=new Date();
var dynamic_update=1;
var dynamic_lastUpdate=dynamic_time.getTime()/1000;
var dynamic_requested=0;
var dynamic_lastRequest=0;
var dynamic_waitingRequest=1;
var dynamic_lastRequestKey="MAD";
var dynamic_requestFrequency=1;
var dynamic_forcedFrequency=2;
var tCount=0;
var lTimeBegin=0;
var lTimeOriginal=0;
var fCount=4;
var noticeMeTime=0;
var noticeMeState=-1;
var wantReload=0;
function dynamic_tick() {
	var a=new Date();
	if((a.getTime()/1000)-dynamic_lastRequest>dynamic_requestFrequency) {
		dynamic_lastUpdate=a.getTime()/1000;
		dynamic_waitingRequest=0;
		dynamic_requestUpdate()
	} else {
		dynamic_waitingRequest=1
	}
	delete a
}

function dynamic_requestUpdate() {
	if(dynamic_update==1) {
		if(dynamic_requested==0) {
			var a=new Date();
			dynamic_lastRequest=a.getTime()/1000;
			ajax_asyncRequestPage("ajax_update/"+dynamic_lastRequestKey+"/"+dynamic_lastRequest+"/",ajax_updateResponse,ajax_timeoutEvent,15000);
			dynamic_requested=1;
			delete a
		}
	}
}

function getTimeStr(b,d,f) {
	var e=d*2;
	if(f!=1) {
		e++
	}
	if(b==1) {
		return lLongTime[e]
	} else {
		return lShortTime[e]
	}
}

function timer_updateAuction(r,q,a,k,j,h,f) {
	if(!f) {
		var m=new Date();
		f=m.getTime();
		delete m
	}
	var b=document.getElementById(r);
	if(b==null) {
		return
	}
	var e=new Number(a-(lTimestamp+(parseInt(f/1000)-lTimeBegin)));
	var i="";
	switch(k) {
		default:
		case 0:
			i=e.toFixed(0);
			break;
		case 1:
			if(a==0) {
				i="<span class='bid_time'>"+lLongTime[11]+"</span>"
			} else {
				var c=e.toFixed(0);
				if((c==2)||(c==5)||(c==10)) {
					dynamic_tick()
				}
				if(c>0) {
					var n=Math.floor(c/(60*60));
					c-=(n*60*60);
					var g=Math.floor(c/60);
					c-=(g*60);
					var o=Math.floor(c);
					if(n>0) {
						if(j==1) {
							i+="<span class='bid_time_highlight'>"+n+"</span><span class='bid_time'> "+getTimeStr(1,2,n)+" </span>"
						} else {
							i+="<span class='hl_bid_time_highlight'>"+n+"</span><span class='hl_bid_time'> "+getTimeStr(1,2,n)+" </span>"
						}
					}
					if((g>0)||(n>0)) {
						if(j==1) {
							i+="<span class='bid_time_highlight'>"+g+"</span><span class='bid_time'> "+getTimeStr(1,1,g)+" </span>"
						} else {
							i+="<span class='hl_bid_time_highlight'>"+g+"</span><span class='hl_bid_time'> "+getTimeStr(1,1,g)+" </span>"
						}
					}
					if(n<1) {
						if(j==1) {
							i+="<span class='bid_time_highlight'>"+o+"</span><span class='bid_time'> "+getTimeStr(1,0,o)+"</span>"
						} else {
							i+="<span class='hl_bid_time_highlight'>"+o+"</span><span class='hl_bid_time'> "+getTimeStr(1,0,o)+"</span>"
						}
					}
					if(f-h<400) {
						i="<span class='bid_time_wrapper_new_bid'>&nbsp;"+i+"&nbsp;</span>"
					} else {
						if(e.toFixed(0)<=10) {
							i="<span class='bid_time_wrapper_critical'>&nbsp;"+i+"&nbsp;</span>"
						} else {
							i="<span class='bid_time_wrapper'>"+i+"</span>"
						}
					}
				} else {
					dynamic_tick();
					i=lLongTime[8]
				}
			}
			break;
		case 2:
			if(a==0) {
				i=lShortTime[11]
			} else {
				var c=e.toFixed(0);
				if(c>0) {
					var p=Math.floor(c/(60*60*24));
					c-=(p*60*60*24);
					var n=Math.floor(c/(60*60));
					c-=(n*60*60);
					var g=Math.floor(c/60);
					c-=(g*60);
					var o=Math.floor(c);
					if(j==1) {
						i="<span class='bid_time_highlight'>"+p+"</span>"+getTimeStr(2,3,p)+", <span class='bid_time_highlight'>"+n+"</span>"+getTimeStr(2,2,n)+", <span class='bid_time_highlight'>"+g+"</span>"+getTimeStr(2,1,g)+", <span class='bid_time_highlight'>"+o+"</span>"+getTimeStr(2,0,o)
					} else {
						i=p+getTimeStr(2,3,p)+", "+n+getTimeStr(2,2,n)+", "+g+getTimeStr(2,1,g)+", "+o+getTimeStr(2,0,o)
					}
				} else {
					i="<span class='bid_time'>"+lShortTime[8]+"</span>"
				}
			}
			break;
		case 10:
			var c=a;
			i=lLongTime[10]+" ";
			var n=Math.floor(c/(60*60));
			c-=(n*60*60);
			var g=Math.floor(c/60);
			c-=(g*60);
			var o=Math.floor(c);
			if(n>0) {
				i+=n+" "+getTimeStr(1,2,n)+" "
			}
			if((g>0)||(n>0)) {
				i+=g+" "+getTimeStr(1,1,g)+" "
			}
			if(n<1) {
				i+=o+" "+getTimeStr(1,0,o)
			}
			i="<span class='bid_time'>"+i+"</span>";
			break;
		case 20:
			break;
		case 61:
			i="<span class='bid_time'>"+lShortTime[12]+"</span>";
			break;
		case 99:
			i="<span class='bid_time'>"+lShortTime[9]+"</span>";
			break
	}
	if(i!="") {
		b.innerHTML=i
	}
	delete e
}

function timer_tick() {
	var e=new Date();
	tCount++;
	var b=0;
	var c=e.getTime();
	if(dynamic_update==1) {
		if(((c/1000)-dynamic_lastUpdate>dynamic_forcedFrequency)||(dynamic_waitingRequest==1)) {
			dynamic_tick()
		}
	}
	if(wantReload==1) {
		if((c/1000)-lTimeOriginal>=120) {
			wantReload=0
		}
	}
	for(b=0;b<auctionCount;b++) {
		if(auctionTypes[b]!=10) {
			var a="tCounter_"+auctionIDs[b];
			timer_updateAuction(a,auctionIDs[b],auctionEndTimes[b],auctionTypes[b],1,auctionLastBidTimes[b],c)
		}
	}
	delete e
}

function timer_initTick() {
	var b=new Date();
	var a=new Number(b.getTime()/1000);
	lTimeBegin=a.toFixed(0);
	lTimeOriginal=lTimeBegin;
	createUserLinks();
	timer_tick();
	setInterval("timer_tick()",1000);
	if(auctionSyncAuctions==1) {
		setInterval("timer_requestNewAuctionData()",120000)
	}
	delete b;
	delete a
}

function ajax_createHttpRequest() {
	if(typeof XMLHttpRequest=="undefined") {
		XMLHttpRequest= function() {
			try {
				return new ActiveXObject("Msxml2.XMLHTTP.6.0")
			} catch(a) {
			}
			try {
				return new ActiveXObject("Msxml2.XMLHTTP.3.0")
			} catch(a) {
			}
			try {
				return new ActiveXObject("Msxml2.XMLHTTP")
			} catch(a) {
			}
			try {
				return new ActiveXObject("Microsoft.XMLHTTP")
			} catch(a) {
			}throw new Error("This browser does not support XMLHttpRequest or XMLHTTP.")
		}
	}
	return new XMLHttpRequest()
}

function ajax_asyncRequestPage(d,c,e,b) {
	var f=ajax_createHttpRequest();
	var a=setTimeout( function(h,g) {
		h(g)
	},b,e,f);
	f.onreadystatechange= function() {
		if(f.readyState==4) {
			if(f.status==200) {
				clearTimeout(a);
				c(d,f)
			} else {
				clearTimeout(a);
				e(f)
			}
		}
	};
	f.open("GET",d,true);
	f.send(null)
}

function ajax_asyncRequestField(d,c,e,b,g) {
	var f=ajax_createHttpRequest();
	var a=setTimeout( function(i,h) {
		i(h)
	},b,e,f);
	f.onreadystatechange= function() {
		if(f.readyState==4) {
			if(f.status==200) {
				clearTimeout(a);
				c(d,f,g)
			} else {
				clearTimeout(a);
				e(f)
			}
		}
	};
	f.open("GET",d,true);
	f.send(null)
}

function ajax_asyncRequestXML(e,d,f,c,a) {
	var g=ajax_createHttpRequest();
	var b=setTimeout( function(i,h) {
		i(h)
	},c,f,g);
	g.onreadystatechange= function() {
		if(g.readyState==4) {
			if(g.status==200) {
				clearTimeout(b);
				d(e,g,a)
			} else {
				clearTimeout(b);
				f(g)
			}
		}
	};
	g.open("GET",e,true);
	g.send(null)
}

function ajax_timeoutCancel(a) {
	if(a!=null) {
		a.abort();
		delete a
	}
	a=null
}

function ajax_timeoutEvent(a) {
	if(a!=null) {
		a.abort();
		delete a
	}
	a=null;
	var b=new Date();
	dynamic_lastUpdate=b.getTime()/1000;
	dynamic_requested=0;
	dynamic_waitingRequest=0;
	delete b
}

function timer_auctionNewBid(b) {
	var a="tCounter_"+auctionIDs[b];
	timer_updateAuction(a,auctionIDs[b],auctionEndTimes[b],auctionTypes[b],1,auctionLastBidTimes[b])
}

function event_auctionNewType(a) {
	var b=document.getElementById("tActionReminder_"+auctionIDs[a]);
	var c=document.getElementById("tActionBid_"+auctionIDs[a]);
	if((auctionTypes[a]==0)||(auctionTypes[a]==1)||(auctionTypes[a]==2)||(auctionTypes[a]==99)) {
		if(b!=null) {
			b.style.display="none"
		}
		if(c!=null) {
			c.style.display="block"
		}
	} else {
		if(b!=null) {
			b.style.display="none"
		}
		if(c!=null) {
			c.style.display="block"
		}
	}
	if((auctionTypes[a]==99)) {
		var e=cookieUser();
		if(e) {
			var d=document.getElementById("auction_title_"+auctionIDs[a]).getElementsByTagName("a")[0].innerHTML;
			if(e==auctionWinners[a]) {
				prompt_showPage("pg_prompt_winauction");
				window.setTimeout( function() {
					document.getElementById("winuser").innerHTML=e;
					document.getElementById("winauction").innerHTML=d
				},500)
			}
		}
	}
}

function event_auctionNewBid(h,i,s) {
	var r=new Date();
	auctionLastBidTimes[h]=r.getTime();
	setTimeout("timer_auctionNewBid("+h+")",450);
	var e="tCounter_"+auctionIDs[h];
	timer_updateAuction(e,auctionIDs[h],auctionEndTimes[h],auctionTypes[h],1,auctionLastBidTimes[h]);
	if(auctionRecordBidderHistory>0) {
		var j=document.getElementById("auction_bidding_history_"+auctionIDs[h]);
		if(j!=null) {
			var k=j.getElementsByTagName("li");
			var f=HTMLToNumber(auctionHighestBids[h])*100;
			var t=0;
			var o="";
			if(k.length>=auctionRecordBidderHistory) {
				j.removeChild(k[k.length-1])
			}
			if(k[0]!=null) {
				t=HTMLToNumber(k[0].innerHTML.toLowerCase().split("</span>")[1])*100
			}
			if(cookieUser()) {
				o='<a id="lastbidder_'+f+'" href=javascript:notification_show("lastbidder_'+f+'",7,"'+auctionWinners[h]+'")>'+auctionWinners[h]+'</a><small class="sneak_over_user"></small>'
			} else {
				o=auctionWinners[h]
			}
			if((t>0)&&(f-t>1)) {
				if(document.getElementById("lastbidders_warning")!=null) {
					o=document.getElementById("lastbidders_warning").innerHTML
				}
				j.innerHTML="<li><span>"+o+"</span>&nbsp;</li>"+j.innerHTML
			} else {
				j.innerHTML="<li><span><var>"+o+"</var></span>"+auctionHighestBids[h]+"</li>"+j.innerHTML
			}
		}
	}
	var q=document.getElementById("auction_price_summary_amount_"+auctionIDs[h]);
	var a=document.getElementById("auction_price_summary_shipping_"+auctionIDs[h]);
	var b=document.getElementById("auction_price_summary_vat_"+auctionIDs[h]);
	var l=document.getElementById("auction_price_summary_total_"+auctionIDs[h]);
	if((q!=null)&&(b!=null)&&(l!=null)) {
		var m=HTMLToNumber(auctionHighestBids[h]);
		var n=0;
		var g=false;
		if(a!=null) {
			n=HTMLToNumber(a.innerHTML);
			g=true
		}
		var u=m+n;
		var c=u*(auctionVATValue-1);
		var p=u+c;
		q.innerHTML=auctionHighestBids[h];
		b.innerHTML=auctionHighestBids[h].replace(",",".").replace(m.toFixed(2),c.toFixed(2));
		l.innerHTML=auctionHighestBids[h].replace(",",".").replace(m.toFixed(2),p.toFixed(2));
		delete m;
		if(g==true) {
			delete n
		}
	}
	delete r
}

function ajax_updateResponse(g,F) {
	var G,I,C,K,O,J,M;
	var u=F.responseText.split("\n");
	var L,b,v,H,z,P;
	var m,o,h,D,q,n,w,e;
	var a;
	var r,l,A;
	var E;
	var B=0;
	var k;
	var N=0;
	var c=0;
	var f=auctionEndTimes.slice(0);
	var t=new Array();
	if(F.responseText.replace(/^\s+|\s+$/g,"")=="NOUPDATE") {
		M=new Date();
		dynamic_lastUpdate=M.getTime()/1000;
		dynamic_requested=0;
		dynamic_waitingRequest=0;
		delete M
	} else {
		for(G=0;G<auctionCount;G++) {
			t[G]=0
		}
		for(I=0;I<u.length;I++) {
			C=u[I];
			if(C.length>0) {
				K=C.split("\t");
				switch(K[0]) {
					case"TK":
						dynamic_lastRequestKey=K[1];
						break;
					case"TS":
						E=parseInt(K[1]);
						break;
					case"B":
						L=parseInt(K[1]);
						b=parseInt(K[2]);
						v=parseInt(K[3]);
						H=K[4];
						z=K[5];
						P=parseInt(K[6]);
						e=K[7];
						up_shake=parseInt(K[8]);
						if(parseInt(K[8])==1) {
							if(typeof abGroup!=="undefined") {
								if(abGroup<2) {
								} else {
									if(auctionWinners[0]!=cookieUser()) {
										shake_element("auction_"+L)
									}
								}
							}
						}
						k=0;
						c++;
						for(G=0;G<auctionCount;G++) {
							if(auctionIDs[G]==L) {
								k=1;
								l=auctionWinners[G];
								r=auctionTypes[G];
								A=auctionEndTimes[G];
								auctionEndTimes[G]=b;
								auctionTypes[G]=v;
								auctionWinners[G]=H;
								auctionHighestBids[G]=z;
								auctionTimeoutTimes[G]=P;
								t[G]=1;
								J=document.getElementById("i_"+L);
								if(J!=null) {
									if(cookieUser()) {
										var x=document.getElementById("tCurBidder_"+L);
										if(x==null) {
											if(HTMLToNumber(z)>0) {
												J.innerHTML='<a id="tCurBidder_'+L+'" href=javascript:notification_show("tCurBidder_'+L+'",7,"'+H+'")>'+H+'</a><small class="sneak_over_user"></small>'
											}
										} else {
											J.innerHTML=J.innerHTML.replace(new RegExp(x.innerHTML,"g"),H)
										}
									} else {
										J.innerHTML=H
									}
								}
								J=document.getElementById("tCurBid_"+L);
								if(J!=null) {
									J.innerHTML=z
								}
								J=document.getElementById("tTimeout_"+L);
								if(J!=null) {
									J.innerHTML=auction_formatTimeout(P)
								}
								if((l!=H)||(A<b)) {
									event_auctionNewBid(G,l,e)
								}
								if(v!=r) {
									event_auctionNewType(G)
								}
								break
							}
						}
						if((k==0)&&((v==0)||(v==1)||(v==2)||(v==10))) {
							N=1
						}
						break
				}
			}
		}
		M=new Date();
		dynamic_lastUpdate=M.getTime()/1000;
		dynamic_requested=0;
		dynamic_waitingRequest=0;
		lTimestamp=E;
		var p=new Number(M.getTime()/1000);
		lTimeBegin=p.toFixed(0);
		for(I=0;I<auctionCount;I++) {
			if(auctionTypes[I]!=10) {
				if(f[I]!=auctionEndTimes[I]) {
					var O="tCounter_"+auctionIDs[I];
					timer_updateAuction(O,auctionIDs[I],auctionEndTimes[I],auctionTypes[I],1,auctionLastBidTimes[I])
				}
			}
		}
		var y=true;
		if(typeof auctionAllowRemoval!=="undefined") {
			if(auctionAllowRemoval==0) {
				y=false
			}
		}
		if(y==true) {
			for(G=0;G<auctionCount;G++) {
				if((t[G]==0)&&(auctionTypes[G]==99)) {
					auction_removeAuction(auctionIDs[G])
				}
			}
		}
		if((N==1)&&(useForcedRefresh==1)&&(c>0)) {
			timedReload()
		}
		delete M;
		delete p;
		delete t
	}
	delete F;
	F=null
}

function timedReload() {
	var b=new Date();
	var a=new Number(b.getTime()/1000);
	if(a-lTimeOriginal<120) {
		wantReload=1
	}
	delete b;
	delete a
}

function ajax_validateFields(b,f,j,h) {
	var e=document.getElementById(f);
	var c=document.getElementById(j);
	if((e==null)||(c==null)) {
		return
	}
	var d=e.value;
	var g=c.value;
	if((d=="")||(g=="")) {
		var a=document.getElementById(h);
		if(a==null) {
			return
		}
		a.innerHTML="";
		return
	}
	ajax_asyncRequestField("pull/?cmd="+urlencode(b)+"&"+urlencode(f)+"="+urlencode(d)+"&"+urlencode(j)+"="+urlencode(g),ajax_responseToField,ajax_timeoutCancel,20000,h)
}

var timeRegister;
function ajax_validateField(e,b,f) {
	var c=document.getElementById(b);
	if(c==null) {
		return
	}
	var a=c.value;
	if(a=="") {
		var d=document.getElementById(f);
		if(d==null) {
			return
		}
		d.innerHTML="";
		return
	}
	ajax_asyncRequestField("pull/?cmd="+urlencode(e)+"&"+urlencode(e)+"="+urlencode(a),ajax_responseToField,ajax_timeoutCancel,20000,f);
	window.clearInterval(timeRegister);
	timeRegister=window.setTimeout( function() {
		if(document.getElementById(f).innerHTML.indexOf(b+"_in_use")>0) {
			document.getElementById(f).innerHTML="";
			prompt_showPage("pg_prompt_re"+b)
		}
	},400)
}

function ajax_responseToField(a,c,d) {
	var b=document.getElementById(d);
	if(b==null) {
		return
	}
	b.innerHTML=c.responseText
}

function getEventKey(b) {
	var a;
	if(b==null) {
		return""
	}
	if(window.event) {
		a=b.keyCode
	} else {
		if(b.which) {
			a=b.which
		} else {
			return""
		}
	}
	return String.fromCharCode(a)
}

function ajax_getSubMarketingChannels(d,b,e) {
	var c=document.getElementById(b);
	var a=c.value;
	ajax_asyncRequestField("pull/?cmd="+urlencode(d)+"&"+urlencode(b)+"="+urlencode(a),ajax_responseToField,ajax_timeoutCancel,20000,e)
}

function ajax_getWinnerInterviewDetails(d,b,e) {
	var c=document.getElementById(b);
	var a=c.value;
	ajax_asyncRequestField("pull/?cmd="+urlencode(d)+"&"+urlencode(b)+"="+urlencode(a),ajax_responseToField,ajax_timeoutCancel,20000,e)
}

function ajax_getWinnerData(b,a,c) {
	ajax_asyncRequestField("pull/?cmd="+urlencode(b)+"&auction_id="+a,ajax_responseToField,ajax_timeoutCancel,20000,c);
	window.setTimeout("slide_winners.init()",500)
}

var entityDiv=null;
function convertEntities(a) {
	if(entityDiv==null) {
		entityDiv=document.createElement("div");
		if(entityDiv!=null) {
			entityDiv.setAttribute("style","display: none;")
		}
	}
	if(entityDiv==null) {
		return a
	}
	entityDiv.innerHTML=a;
	return entityDiv.innerHTML
}

function auction_formatTimeout(a) {
	if(a>=60) {
		return(Math.round((a/60)*10)/10)+" "+lShortTime[3]
	} else {
		return a+" "+lShortTime[1]
	}
}

function timer_requestNewAuctionData() {
	var b=new Date();
	var a=b.getTime()/1000;
	ajax_asyncRequestXML("xml/auction/update/"+parseInt(a)+"/",ajax_newAuctionDataResponse,ajax_timeoutCancel,15000)
}

function ajax_getXMLNodeValue(b,a) {
	if(b==null) {
		return""
	}
	var c=b.getElementsByTagName(a);
	if(c!=null) {
		var d=c.item(0);
		if(d!=null) {
			if(typeof d.textContent!=="undefined") {
				return d.textContent
			} else {
				return d.text
			}
		}
	}
	return""
}

function ajax_newAuctionDataResponse(b,f) {
	if(f.responseText=="") {
		return
	}
	var a=f.responseXML;
	var e=a.getElementsByTagName("auction_list");
	if(e!=null) {
		var d=e.item(0);
		if(d!=null) {
			if(d.childNodes!=null) {
				for(var c=0;c<d.childNodes.length;c++) {
					var g=d.childNodes.item(c);
					var h=parseInt(ajax_getXMLNodeValue(g,"auction_id"));
					if(auction_exists(h)==false) {
						if((auctionShowRookies==2)||((auctionShowRookies==1)&&(parseInt(ajax_getXMLNodeValue(g,"flag_new_paid_users"))==0))||((auctionShowRookies==0)&&(parseInt(ajax_getXMLNodeValue(g,"flag_new_users_only"))==0)&&(parseInt(ajax_getXMLNodeValue(g,"flag_new_paid_users"))==0))) {
							auction_insertAuction(h,g)
						}
					}
				}
			}
			auction_resortList(d);
			auction_rookies()
		}
	}
	f=null
}

function auction_exists(b) {
	for(var a=0;a<auctionCount;a++) {
		if(auctionIDs[a]==b) {
			return true
		}
	}
	return false
}

function auction_getAuctionIndex(b) {
	for(var a=0;a<auctionCount;a++) {
		if(auctionIDs[a]==b) {
			return a
		}
	}
	return -1
}

function auction_insertAuction(b,g) {
	auctionEndTimes[auctionCount]=parseInt(ajax_getXMLNodeValue(g,"auction_iut"));
	auctionTypes[auctionCount]=parseInt(ajax_getXMLNodeValue(g,"auction_itype"));
	auctionIDs[auctionCount]=b;
	auctionWinners[auctionCount]=ajax_getXMLNodeValue(g,"winner");
	auctionHighestBids[auctionCount]=ajax_getXMLNodeValue(g,"cur_bid");
	auctionLastBidTimes[auctionCount]=0;
	var n=auctionCount;
	auctionCount++;
	var e=document.getElementById("bidsys_auction_list");
	var q=document.getElementById("auction___BID_ID__");
	if((e!=null)&&(q!=null)) {
		var o=q.cloneNode(true);
		o.setAttribute("id","auction_"+b);
		o.removeAttribute("style");
		var k=o.innerHTML;
		k=k.replace(/__BID_ID__/g,b);
		k=k.replace(/__BID_TITLE__/g,ajax_getXMLNodeValue(g,"title"));
		k=k.replace(/__BID_PRODUCT_IMAGE__/g,ajax_getXMLNodeValue(g,"image_"+auctionImageType));
		k=k.replace(/__BID_VALUE__/g,ajax_getXMLNodeValue(g,"item_price"));
		k=k.replace(/__BID_TIMEOUT__/g,ajax_getXMLNodeValue(g,"timeout"));
		k=k.replace(/__BID_TIME_LEFT__/g,ajax_getXMLNodeValue(g,"time_left"));
		k=k.replace(/__BID_AMOUNT__/g,ajax_getXMLNodeValue(g,"cur_bid"));
		k=k.replace(/__BID_WINNER_NAME__/g,ajax_getXMLNodeValue(g,"winner"));
		k=k.replace(/__BID_DIRECTIONS__/g,ajax_getXMLNodeValue(g,"sms_str"));
		k=k.replace(/__URI_BID_TEXT__/g,"");
		k=k.replace(/__BID_FLAG_CHARITY__/g,"");
		o.innerHTML=k;
		if(e.firstChild!=null) {
			var m=e.firstChild;
			var a=false;
			do {
				if(m.nodeType==1) {
					if(m.id!=null) {
						var r=parseInt(HTMLToNumber(m.id));
						var j=auction_getAuctionIndex(r);
						if(j!=-1) {
							if((auctionTypes[j]>2)&&(auctionTypes[j]!=99)) {
								e.insertBefore(o,m);
								a=true;
								break
							}
						}
					}
				}
				if(m.nextSibling!=null) {
					m=m.nextSibling
				} else {
					m=null
				}
			} while((m!=null)&&(a==false));
			if(a==false) {
				e.appendChild(o)
			}
		} else {
			e.appendChild(o)
		}
		var i=document.getElementById("auction_product_img_"+b);
		if(i!=null) {
			i.setAttribute("src",ajax_getXMLNodeValue(g,"image_"+auctionImageType));
			i.setAttribute("alt",ajax_getXMLNodeValue(g,"title"))
		}
		if((auctionTypes[n]==0)||(auctionTypes[n]==1)||(auctionTypes[n]==2)||(auctionTypes[n]==99)) {
			auction_hideAuctionFlag(b,"tActionBid","block");
			auction_hideAuctionFlag(b,"tActionReminder","none")
		} else {
			auction_hideAuctionFlag(b,"tActionBid","none");
			auction_hideAuctionFlag(b,"tActionReminder","block")
		}
		if(parseInt(ajax_getXMLNodeValue(g,"flag_buynow"))==0) {
			auction_hideAuctionFlag(b,"flag_buynow")
		}
		if(parseInt(ajax_getXMLNodeValue(g,"flag_is_international"))==0) {
			auction_hideAuctionFlag(b,"flag_is_international")
		}
		if(parseInt(ajax_getXMLNodeValue(g,"flag_free_bidding"))==0) {
			auction_hideAuctionFlag(b,"flag_bid4free")
		}
		if(parseInt(ajax_getXMLNodeValue(g,"flag_new_users_only"))==0) {
			auction_hideAuctionFlag(b,"flag_rookie")
		}
		if(parseInt(ajax_getXMLNodeValue(g,"flag_24h"))==0) {
			auction_hideAuctionFlag(b,"flag_24h")
		}
		var l=new Date();
		auction_setNotice(b,l.getTime(),120);
		delete l
	}
}

function auction_setNotice(a,k,e) {
	var p=document.getElementById("auction_title_"+a);
	if(p!=null) {
		var l=new Date();
		if(l.getTime()<k+(e*1000)) {
			var i=178;
			var o=221;
			var b=242;
			var n=255;
			var c=255;
			var h=255;
			var j=(l.getTime()-k)/(e*1000);
			if(j>0) {
				j=j
			}
			if(j<0) {
				j=0
			}
			if(j>1) {
				j=1
			}
			var g=i+j*(n-i);
			var m=o+j*(c-o);
			var q=b+j*(h-b);
			p.style.backgroundColor="rgb("+parseInt(g)+", "+parseInt(m)+", "+parseInt(q)+")";
			setTimeout("auction_setNotice( "+a+", "+k+", "+e+" )",500)
		} else {
			p.style.backgroundColor="#FFFFFF"
		}
		delete l
	}
}

function auction_hideAuctionFlag(c,d,a) {
	var b=document.getElementById(d+"_"+c);
	if(b!=null) {
		b.style.display=a||"none"
	}
}

function auction_removeAuction(d) {
	for(var b=0;b<auctionCount;b++) {
		if(auctionIDs[auctionCount]==d) {
			for(var a=b+1;a<auctionCount;a++) {
				auctionEndTimes[a-1]=auctionEndTimes[a];
				auctionTypes[a-1]=auctionTypes[a];
				auctionIDs[a-1]=auctionIDs[a];
				auctionWinners[a-1]=auctionWinners[a];
				auctionHighestBids[a-1]=auctionHighestBids[a];
				auctionLastBidTimes[a-1]=auctionLastBidTimes[a]
			}
			auctionEndTimes[auctionCount-1]=0;
			auctionTypes[auctionCount-1]=0;
			auctionIDs[auctionCount-1]=0;
			auctionWinners[auctionCount-1]="";
			auctionHighestBids[auctionCount-1]="";
			auctionLastBidTimes[auctionCount-1]=0;
			auctionCount--
		}
	}
	var e=document.getElementById("auction_"+d);
	if((e!=null)&&(e.parentNode.id!="bidsys_auction_list_closed")) {
		e.parentNode.removeChild(e)
	}
}

function updateImage(b,a) {
	document[b].src=a
}

function ajax_validateRegisterField(d,b,e) {
	var c=document.getElementById(b);
	var a=c.value;
	ajax_asyncRequestField("pull/?cmd="+urlencode(d)+"&"+urlencode(d)+"="+urlencode(a),ajax_responseToField,ajax_timeoutCancel,20000,e)
}

function auction_resortList(e) {
	var f=document.getElementById("bidsys_auction_list");
	if(f.getElementsByTagName("li").length>=0) {var j=f.getElementsByTagName("li")[0]
	} else {
		return
	}
	for(var d=0;d<(e.childNodes.length);d++) {
		var c=j.getAttribute("id");
		var b=ajax_getXMLNodeValue(e.childNodes[d],"auction_id");
		var g=ajax_getXMLNodeValue(e.childNodes[d],"flag_new_users_only");
		if(((auctionShowRookies==0)&&(g==0))||(auctionShowRookies==1)) {
			if(f.innerHTML.indexOf("auction_"+b)>=0) {
				if(HTMLToNumber(c)!=HTMLToNumber(b)) {
					var h=j.cloneNode(true);
					var a=document.getElementById("auction_"+b);
					j.innerHTML=a.innerHTML;
					j.id="auction_"+b;
					a.innerHTML=h.innerHTML;
					a.id=h.getAttribute("id")
				}
				do {
					j=j.nextSibling;
					if(j==null) {
						return
					}
				} while(j.nodeType!=1)
			}
		}
	}
}

function auction_bid(b) {
	var e=new Date();
	var a=e.getTime();
	if((b==lastBidClickID)&&((a-lastBidClickTime)<10000)) {
		notification_show("tActionBid_"+b,6,"")
	} else {
		lastBidClickTime=a;
		var c=setTimeout("notification_show( 'tActionBid_"+b+"', 6, '')",750);
		ajax_asyncRequestXML("xml/bid/"+b+"/",ajax_processAuctionBid,ajax_timeoutCancel,30000,c);
		if(pageTracker!=null) {
			pageTracker._trackEvent("bidbutton",window.location.pathname,b)
		}
	}
	lastBidClickID=b
}

function auction_remind(b,a) {
	var c=setTimeout("notification_show( 'tActionReminder_"+b+"', 6, '')",750);
	ajax_asyncRequestXML("xml/reminder/"+b+"/"+a+"/",ajax_processAuctionBid,ajax_timeoutCancel,30000,c)
}

function user_setBidsLeft(b) {
	var a=document.getElementById("user_bids_left");
	if(a!=null) {
		a.innerHTML=b
	}
}

var lastBidClickTime=dynamic_time.getTime();
var lastBidClickID;
function ajax_processAuctionBid(g,p,r) {
	if(p.responseText=="") {
		return
	}
	clearTimeout(r);
	lastBidClickID=0;
	var f=p.responseXML;
	if(f.getElementsByTagName("result").length>=0) {
		f=f.getElementsByTagName("result")[0]
	} else {
		return
	}
	var k=parseInt(ajax_getXMLNodeValue(f,"state"));
	var a=ajax_getXMLNodeValue(f,"auction_id");
	var s="tActionBid";
	var x=parseInt(ajax_getXMLNodeValue(f,"object_id"));
	if(x>0) {
		var e=auction_getAuctionIndex(a);
		var i=document.getElementById("auction_"+a);
		i.id="auction_"+x;
		i.innerHTML=i.innerHTML.replace(new RegExp(a,"g"),x);
		auctionIDs[e]=x;
		a=x
	}
	if(document.getElementById("tActionReminder_"+a)!=null) {
		if(document.getElementById("tActionReminder_"+a).style.display!="none") {
			s="tActionReminder"
		}
	}
	switch(k) {
		case 401:
			notification_show(s+"_"+a,4,"");
			break;
		case 307:
			if(ajax_getXMLNodeValue(f,"message")!=null) {
				window.location.href=ajax_getXMLNodeValue(f,"message")
			}
			break;
		case 406:
			break;
		case 200:
			if(s=="tActionBid") {
				var h=auction_getAuctionIndex(a);
				var l=auctionWinners[h];
				auctionEndTimes[h]=parseInt(ajax_getXMLNodeValue(f,"auction_iut"));
				auctionTypes[h]=parseInt(ajax_getXMLNodeValue(f,"auction_itype"));
				auctionWinners[h]=ajax_getXMLNodeValue(f,"winner");
				auctionHighestBids[h]=ajax_getXMLNodeValue(f,"cur_bid");
				event_auctionNewBid(h,l,ajax_getXMLNodeValue(f,"auction_formatted_time"));
				if(ajax_getXMLNodeValue(f,"funding_new_total")!="") {
					if(document.getElementById("unused_bids")!=null) {
						document.getElementById("unused_bids").innerHTML=ajax_getXMLNodeValue(f,"funding_new_total")
					}
				}
				var m=document.getElementById("tCurBidder_"+a);
				if(m!=null) {
					m.parentNode.innerHTML=m.parentNode.innerHTML.replace(new RegExp(m.innerHTML,"g"),ajax_getXMLNodeValue(f,"winner"))
				}
				if(ajax_getXMLNodeValue(f,"user_bids_left")!="") {
					user_setBidsLeft(ajax_getXMLNodeValue(f,"user_bids_left"))
				}
				auction_highlight(a);
				var v=new Date();
				var j=v.getTime();
				var c="tCounter_"+auctionIDs[h];
				timer_updateAuction(c,auctionIDs[h],auctionEndTimes[h],auctionTypes[h],1,auctionLastBidTimes[h],j)
			}
			break;
		default:
			break
	}
	if(ajax_getXMLNodeValue(f,"message_type")!="") {
		var u=parseInt(ajax_getXMLNodeValue(f,"message_type"));
		var o=ajax_getXMLNodeValue(f,"message_title");
		var t=ajax_getXMLNodeValue(f,"message_content");
		var n="javascript:prompt_close()";
		var w="Close";
		if(ajax_getXMLNodeValue(f,"message_url")!="") {
			n=ajax_getXMLNodeValue(f,"message_url")
		}
		if(ajax_getXMLNodeValue(f,"message_button_title")!="") {
			w=ajax_getXMLNodeValue(f,"message_button_title")
		}
		prompt_show(o,t,u,n,w)
	}
	if(ajax_getXMLNodeValue(f,"notification_type")!="") {
		var q=ajax_getXMLNodeValue(f,"notification_type");
		var b=ajax_getXMLNodeValue(f,"notification_content");
		notification_show(s+"_"+a,q,b)
	}
}

function prompt_show(d,g,f,b,c) {
	if(document.getElementById("prompt_black")==null) {
		var h=document.createElement("div");
		var e="";
		var a;
		h.id="prompt_black";
		h.innerHTML="&nbsp;";
		document.body.appendChild(h);
		switch(f) {
			case 1:
				a="i_sucess";
				break;
			case 2:
			case 3:
				a="i_warning";
				break;
			case 4:
				a="i_offer";
				break;
			case 5:
				a="i_rookie";
				break;
			case 6:
				a="i_free";
				break;
			default:
				a="";
				break
		}
		if(document.getElementById("box_prompt")!=null) {
			e=document.getElementById("box_prompt").innerHTML;
			e=e.replace("h1text",d);
			e=e.replace("h3text",g);
			e=e.replace("classimg",a);
			e=e.replace("#",b);
			e=e.replace("atext",c)
		}
		h=document.createElement("div");
		h.id="prompt_page";
		h.className="static";
		h.innerHTML=e;
		document.body.appendChild(h)
	}
}

function prompt_showPage(c,a) {
	prompt_close();
	var b=document.createElement("div");
	b.id="prompt_black";
	b.innerHTML="&nbsp;";
	document.body.appendChild(b);
	b=document.createElement("div");
	b.id="prompt_page";
	b.className="static";
	if(document.getElementById("prompt_loading")!=null) {
		b.innerHTML=document.getElementById("prompt_loading").innerHTML
	}
	document.body.appendChild(b);
	if(a==true) {
		ajax_asyncRequestPage(c,ajax_setPageContent,ajax_timeoutCancel,5000,"")
	} else {
		ajax_asyncRequestXML("xml/page/"+c,ajax_setPromptContent,ajax_timeoutCancel,5000,"")
	}
}

function prompt_close() {
	if(document.getElementById("prompt_black")!=null) {
		document.body.removeChild(document.getElementById("prompt_black"));
		document.body.removeChild(document.getElementById("prompt_page"))
	}
}

function ajax_setPromptContent(b,c) {
	if(c.responseText=="") {
		return
	}
	var a=c.responseXML;
	var d;
	if(a.getElementsByTagName("result").length>=0) {
		a=a.getElementsByTagName("result")[0];
		d=parseInt(ajax_getXMLNodeValue(a,"state"))
	}
	if((d==200)&&(document.getElementById("prompt_page")!=null)) {
		document.getElementById("prompt_page").getElementsByTagName("p")[0].innerHTML="";
		document.getElementById("prompt_page").innerHTML+=ajax_getXMLNodeValue(a,"message")
	}
}

function ajax_setPageContent(a,b) {
	if(b.responseText=="") {
		return
	}
	if((document.getElementById("prompt_page")!=null)) {
		document.getElementById("prompt_page").getElementsByTagName("p")[0].innerHTML="";
		document.getElementById("prompt_page").innerHTML+=b.responseText
	}
}

function element_getXY(b) {
	var a=0,c=0;
	if(b===document.body) {
		return {
			x:0,
			y:0
		}
	}
	if(b.getBoundingClientRect) {
		rect=b.getBoundingClientRect();
		if(!document.body.scrollTop) {
			scrollLeft=document.documentElement.scrollLeft;
			scrollTop=document.documentElement.scrollTop
		} else {
			scrollLeft=document.body.scrollLeft;
			scrollTop=document.body.scrollTop
		}
		a=rect.left+scrollLeft;
		c=rect.top+scrollTop
	} else {
		a=b.offsetLeft;
		c=b.offsetTop;
		parent=b.offsetParent;
		if(parent!=b) {
			while(parent) {
				a+=parent.offsetLeft;
				c+=parent.offsetTop;
				parent=parent.offsetParent
			}
		}
		parent=b.offsetParent;
		while((parent)&&(parent!=document.body)) {
			a-=parent.scrollLeft;
			parent=parent.offsetParent
		}
	}
	return {
		x:a,
		y:c
	}
}

function element_fade(e,c,b,a) {
	var f=e;
	for(var d=1;d<=100;d++) {
		(function(g) {
			setTimeout( function() {
				if(a==true) {
					g=100-g
				}
				e.style.opacity=g/100;
				e.style.MozOpacity=g/100;
				e.style.KhtmlOpacity=g/100;
				e.style.zoom=1;
				e.style.display="block";
				if((g==100)&&(b!=undefined)) {
					b.call(this,f)
				} else {
					if((a==true)&&(b!=undefined)&&(g==0)) {
						b.call(this,f)
					}
				}
				e.style.filter="alpha(opacity="+g+");"
			},g*c/100)
		})(d)
	}
}

var prevNotificationTimeout=null;
function notification_show(a,c,f) {
	notification_hide();
	var h=document.createElement("div");
	var e=document.getElementById(a);
	var i=element_getXY(e);
	var g;
	var d=3000;
	if((h!=null)&&(e!=null)) {
		switch(parseInt(c)) {
			case 1:
				d=1000;
			case 2:
			case 3:
				if(document.getElementById("box_message")!=null) {
					g=document.getElementById("box_message").innerHTML;
					g=g.replace("messagebox",f)
				}
				break;
			case 4:
				if(document.getElementById("box_login")!=null) {
					g=document.getElementById("box_login").innerHTML
				}
				break;
			case 5:
				if(document.getElementById("box_reminder")!=null) {
					g=document.getElementById("box_reminder").innerHTML;
					g=g.replace("auction_remind()","auction_remind('"+a.split("_")[1]+"',document.getElementById('timeout').value)");
					document.getElementById("timeout").value=5
				}
				break;
			case 6:
				if(document.getElementById("box_loading")!=null) {
					g=document.getElementById("box_loading").innerHTML
				}
				break;
			case 7:
				if(document.getElementById("box_sneak")!=null) {
					g=document.getElementById("box_sneak").innerHTML;
					g=g.replace("replaceUser",f);
					g=g.replace("replaceID",a);
					g=g.replace("temp_sneak_message","m_message")
				}
				break;
			case 8:
				if(document.getElementById("box_moreinfo")!=null) {
					g=document.getElementById("box_moreinfo").innerHTML;
					g=g.replace("replaceID",auctionIDs[0]);
					g=g.replace("temp_moreinfo_message","m_message")
				}
				break;
			default:
				g="";
				break
		}
		var b=document.getElementById("tooltip");
		if(b!=null) {
			document.body.removeChild(b)
		}
		if(prevNotificationTimeout!=null) {
			clearTimeout(prevNotificationTimeout);
			prevNotificationTimeout=null
		}
		h.id="tooltip";
		h.innerHTML=g;
		document.body.appendChild(h);
		h.style.top=i.y-(h.offsetHeight)+"px";
		h.style.left=i.x+(e.offsetWidth/2)-(h.offsetWidth/2)+"px";
		h.style.display="none";
		element_fade(h,150);
		if(c<4) {
			prevNotificationTimeout=setTimeout( function() {
				element_fade(h,400, function(j) {
					b=document.getElementById("tooltip");
					if(b!=null) {
						document.body.removeChild(b)
					}
					prevNotificationTimeout=null
				},true)
			},d)
		}
	}
}

function notification_hide() {
	if(document.getElementById("tooltip")!=null) {
		document.body.removeChild(document.getElementById("tooltip"))
	}
}

function Section(d) {
	var b=0;
	var e=document.getElementById("static_right").getElementsByTagName("div");
	var c=document.getElementById("static_left").getElementsByTagName("a");
	this.name=d;
	this.show= function(a) {
		if(document.getElementById("search_input")!=null) {
			this.searchReset()
		}
		document.getElementById("section"+b).style.display="none";
		document.getElementById("section"+a).style.display="block";
		document.getElementById("link"+b).className="none";
		document.getElementById("link"+a).className="selected";
		b=a;
		window.scrollTo(0,0)
	};
	this.subsection= function(f) {
		var a=document.getElementById("static_left").getElementsByTagName("div");
		if(a[f]!=null) {
			if(a[f].style.display=="block") {
				a[f].style.display="none"
			} else {
				a[f].style.display="block"
			}
		}
	};
	this.searchText= function() {
		var u=document.getElementById("search_input").value;
		u=u.replace(/^\s\s*/,"").replace(/\s\s*$/,"");
		u=u.toLowerCase();
		this.searchReset();
		if(u!="") {
			var s=0;
			var q;
			for(var o=0;o<e.length;o++) {
				q=e[o].innerHTML;
				if(q.toLowerCase().indexOf(u)!=-1) {
					var a=new RegExp(u,"gi");
					var g=true;
					var p="";
					var r=new Array();
					var t=0;
					for(var n=0;n<=q.length;n++) {
						if(q.charAt(n)=="<") {
							g=true;
							p+=q.charAt(n)
						} else {
							if(q.charAt(n)==">") {
								g=false;
								p+=q.charAt(n);
								r[t]=p;
								t++;
								p=""
							} else {
								if(g==true) {
									p+=q.charAt(n)
								}
							}
						}
					}
					for(var l in r) {
						q=q.replace(r[l],"###"+l)
					}
					for(var h=0;h<q.length-u.length;h++) {
						if(q.substring(h,h+u.length).toLowerCase()==u.toLowerCase()) {
							var f='<span class="search_text">'+q.substring(h,h+u.length)+"</span>";
							q=q.substring(0,h)+f+q.substring(h+u.length);
							h+=f.length-1
						}
					}
					for(var l in r) {
						q=q.replace("###"+l,r[l])
					}
					e[o].innerHTML=q;
					e[o].style.display="block"
				} else {
					e[o].style.display="none";
					s++
				}
			}
			if(s==e.length) {
				document.getElementById("search_result").innerHTML="Your search <b>'"+u+"'</b> did not match"
			} else {
				document.getElementById("search_result").innerHTML="Searches related to <b>'"+u+"'</b>"
			}
		} else {
			document.getElementById("search_result").innerHTML="<b>Your search did not match</b>"
		}
	};
	this.searchReset= function() {
		document.getElementById("static_right").innerHTML=document.getElementById("static_right").innerHTML.replace(/search_text/g,"");
		document.getElementById("search_input").value="";
		document.getElementById("search_result").innerHTML="";
		for(var a=0;a<e.length;a++) {
			e[a].style.display="none"
		}
	};
	this.searchPressKey= function(f) {
		var a;
		if(window.event) {
			a=f.keyCode
		}
		if(f.which) {
			a=f.which
		}
		if(a==13) {
			this.searchText()
		}
	};
	if(window.location.hash!="") {
		this.show(window.location.hash.split("#")[1])
	} else {
		this.show(0)
	}
}

function AutoBid() {
	var e=true;
	var d=document.getElementById("autolist").getElementsByTagName("li");
	var a=new Array();
	var c=new Array("none","block");
	if(d!=null) {
		for(var b=0;b<d.length;b++) {
			a[b]=d[b].getElementsByTagName("span")[0].innerHTML.toLowerCase()
		}
	}
	this.reLoad= function() {
		if(document.getElementById("autotext")!=null) {
			document.getElementById("autotext").value="";
			this.keyPress();
			this.displayList(0)
		}
	};
	this.displayList= function(f) {
		if(document.getElementById("autotext")!=null) {
			if(e==true) {
				document.getElementById("autotext").value="";
				e=false
			}
			document.getElementById("autolist").style.display=c[f];
			document.getElementById("autotext").className=c[f];
			document.getElementById("autof").getElementsByTagName("a")[0].style.display=c[f];
			document.getElementById("autof").getElementsByTagName("a")[1].style.display=c[1-f]
		}
	};
	this.setName= function(f) {
		if(document.getElementById("autotext")!=null) {
			document.getElementById("autotext").value=f.getElementsByTagName("span")[0].innerHTML;
			document.getElementById("auction_id").value=f.getElementsByTagName("span")[0].className;
			this.displayList(0)
		}
	};
	this.keyPress= function() {
		this.displayList(1);
		var g=document.getElementById("autotext").value.toLowerCase();
		for(var f in a) {
			d[f].style.display=c[Math.ceil((a[f].indexOf(g)+1)/100)]
		}
	};
	if(window.location.href.indexOf("edit_autobid")!=-1) {
		if(document.getElementById("autotext")!=null) {
			document.getElementById("autotext").value=d[0].getElementsByTagName("span")[0].innerHTML;
			document.getElementById("autotext").className="none"
		}
	}
}

function DivSlide(c,e) {
	var a,d,b;
	this.automatic=false;
	this.name=c;
	if(e>0) {
		this.automatic=window.setInterval(this.name+".goNext(true)",e)
	}
	this.init= function() {
		if(document.getElementById(this.name)!=null) {
			a=document.getElementById(this.name).getElementsByTagName("div")[0];
			d=0;
			b=a.getElementsByTagName("div").length;
			moving=false;
			if((this.name=="slide_photos")&&(b>1)) {
				if(document.getElementById("winner_arrows")!=null) {
					document.getElementById("winner_arrows").innerHTML='<a href="javascript:slide_photos.goPrev(false)" class="arrowl" title="Previous"></a><a href="javascript:slide_photos.goNext(false)" class="arrowr" title="Next"></a>'
				}
			}
			if(document.getElementById(this.name+"_links")!=null) {
				var f="";
				for(var g=0;g<b;g++) {
					f+="<a href='javascript:"+this.name+".goTo("+g+",false)'></a>"
				}
				document.getElementById(this.name+"_links").innerHTML=f;
				document.getElementById(this.name+"_links").getElementsByTagName("a")[0].className="active"
			}
			a.getElementsByTagName("div")[0].style.display="block"
		}
	};
	this.goTo= function(f,g) {
		if((g==false)&&(this.automatic!=false)) {
			window.clearInterval(this.automatic)
		}
		if(document.getElementById(this.name+"_links")!=null) {
			document.getElementById(this.name+"_links").getElementsByTagName("a")[d].className="inactive";
			document.getElementById(this.name+"_links").getElementsByTagName("a")[f].className="active"
		}
		element_fade(a.getElementsByTagName("div")[d],500,null,true);
		a.getElementsByTagName("div")[d].style.zIndex="1";
		element_fade(a.getElementsByTagName("div")[f],500);
		a.getElementsByTagName("div")[f].style.zIndex="2";
		d=f
	};
	this.goNext= function(f) {
		this.goTo((d>=(b-1))?0:(d+1),f)
	};
	this.goPrev= function(f) {
		this.goTo((d==0)?(b-1):(d-1),f)
	};
	this.init()
}

function loadScriptAsync(a,c) {
	var b=document.createElement("script");
	b.type="text/javascript";
	b.async=true;
	if(b.readyState) {
		b.onreadystatechange= function() {
			if((b.readyState==="loaded")||(b.readyState==="complete")) {
				b.onreadystatechange=null;
				c()
			}
		}
	} else {
		b.onload= function() {
			c()
		}
	}
	b.src=a;
	document.getElementsByTagName("head")[0].appendChild(b)
}

function displayBankDetails(a) {
	if(document.getElementById("extra_data_"+a)!=null) {
		document.getElementById("extra_data_"+(3-a)).style.display="none";
		document.getElementById("extra_data_"+a).style.display="block"
	}
}

function displayCardIssueNumber(b,c,d,a) {
	if(a==false) {
		return
	}
	if(document.getElementById(d)!=null) {
		txt=b.options[b.selectedIndex].value;
		document.getElementById(d).style.display="none";
		textArray=c.split(":");
		if(txt.match(textArray[0])||txt.match(textArray[1])) {
			document.getElementById(d).style.display="block"
		}
	}
}

function displayCardIssueDate(b,c,d,a) {
	if(a==false) {
		return
	}
	if(document.getElementById(d)!=null) {
		txt=b.options[b.selectedIndex].value;
		document.getElementById(d).style.display="none";
		textArray=c.split(":");
		if(txt.match(textArray[0])||txt.match(textArray[1])) {
			document.getElementById(d).style.display="inline-block"
		}
	}
}

function sortSearchByOption(a,c,b) {
	newUrl=a+c+"/0";
	if(b!="") {
		newUrl=newUrl+"/"+b
	}
	window.location.href=newUrl
}

function sortProductsByOption(a,b) {
	newUrl=a+b+"/0";
	window.location.href=newUrl
}

function submitSearchNextNavigationForm(a) {
	document.getElementById("next"+a).submit()
}

function submitSearchPrevNavigationForm(a) {
	document.getElementById("prev"+a).submit()
}

function sidebar_facebook(b) {
	document.writeln('<fb:fan profile_id="'+b+'" width="235" height="175" connections="4" stream="false" header="false" border="0" css="%URL_ROOT%css/facebook.css?1"></fb:fan>');
	var a=("https:"==document.location.protocol?"https://":"http://")+"connect.facebook.net/en_US/all.js";
	loadScriptAsync(a, function() {
		window.fbAsyncInit= function() {
			FB.init({
				appId:facebook_apiKey,
				status:true,
				cookie:true,
				xfbml:true
			})
		}
	})
}

function SubBar() {
	var a=document.getElementById("sub_bar");
	var h=1;
	var g="my_whosneak";
	var e=-1;
	this.show= function(i) {
		a.className="static "+i
	};
	this.toggle= function() {
		if(a.className=="static close") {
			if(e==-1) {
				this.submenu(g,h)
			} else {
				this.show("open")
			}
		} else {
			this.show("close")
		}
	};
	this.submenu= function(j,i) {
		if(a.className=="static close") {
			this.show("open")
		}
		document.getElementById("sublink"+h).className="unselected";
		document.getElementById("sublink"+i).className="selected";
		document.getElementById("sub"+h).style.display="none";
		document.getElementById("sub"+i).style.display="block";
		document.getElementById(g).className="unselected";
		document.getElementById(j).className="selected";
		document.getElementById("div_"+g).style.display="none";
		document.getElementById("div_"+j).style.display="block";
		h=i;
		g=j;
		e=0;
		switch(j) {
			case"my_whosneak":
				ajax_asyncRequestField("pull/?cmd="+j,ajax_responseToField,ajax_timeoutCancel,20000,"nav_"+j);
				ajax_asyncRequestField("pull/?cmd=getdefaultsneakdetails",ajax_responseToField,ajax_timeoutCancel,20000,"section_"+j);
				this.getSneaks();
				break;
			case"my_whoisneak":
				ajax_asyncRequestField("pull/?cmd="+j,ajax_responseToField,ajax_timeoutCancel,20000,"nav_"+j);
				ajax_asyncRequestField("pull/?cmd=getdefaultmysneakdetails",ajax_responseToField,ajax_timeoutCancel,20000,"section_"+j);
				break;
			case"my_auction":
				ajax_asyncRequestField("pull/?cmd="+j,ajax_responseToField,ajax_timeoutCancel,20000,"nav_"+j);
				ajax_asyncRequestField("pull/?cmd=getdefaultauctiondetails",ajax_responseToField,ajax_timeoutCancel,20000,"section_"+j);
				break;
			case"my_stealth":
				ajax_asyncRequestField("pull/?cmd="+j,ajax_responseToField,ajax_timeoutCancel,20000,"section_"+j);
				break;
			default:
				break
		}
	};
	this.leftmenu= function(k,j,l,m) {
		var i=document.getElementById("nav_"+g).getElementsByTagName("a");
		i[e].className="unselected";
		i[j].className="selected";
		e=j;
		switch(k) {
			case"get_auction":
				ajax_asyncRequestField("pull/?cmd="+k+"&auction_id="+urlencode(l)+"&user_action_id="+urlencode(m),ajax_responseToField,ajax_timeoutCancel,20000,"section_my_auction");
				break;
			case"get_user":
				ajax_asyncRequestField("pull/?cmd="+k+"&targetUserName="+urlencode(l)+"&user_notification_id="+urlencode(m),ajax_responseToField,ajax_timeoutCancel,20000,"section_my_whosneak");
				break;
			case"get_mysneak":
				ajax_asyncRequestField("pull/?cmd="+k+"&targetUserName="+urlencode(l)+"&user_action_id="+urlencode(m),ajax_responseToField,ajax_timeoutCancel,20000,"section_my_whoisneak");
				break;
			default:
				break
		}
	};
	this.getSneaks= function() {
		ajax_asyncRequestField("pull/?cmd=sneaks",ajax_responseToField,ajax_timeoutCancel,20000,"usersneaks")
	};
	this.buyStealth= function(i) {
		if(i=="true") {
			ajax_asyncRequestField("pull/?cmd=buystealthmode",ajax_responseToField,ajax_timeoutCancel,20000,"b_message");
			user_setBidsLeft(document.cookie.split(cookiePrefix+"bidsys_credits=")[1].split(";")[0])
		} else {
			if(i=="cancel") {
				document.getElementById("b_message2").style.display="none"
			} else {
				document.getElementById("b_message2").style.display="block"
			}
		}
	};
	this.getSneaks();
	if((document.cookie.indexOf(cookiePrefix+"sneak_last_update=")!=-1)&&(document.cookie.indexOf(cookiePrefix+"sneak_num_new_notifications=")!=-1)) {
		var c=document.cookie.split(cookiePrefix+"sneak_last_update=")[1].split(";")[0];
		var b=document.cookie.split(cookiePrefix+"sneak_num_new_notifications=")[1].split(";")[0];
		var d=new Date().getTime()/1000;
		var f=900000;
		if(((d-f)>c)&&(b=="0")) {
			window.setInterval(this.getSneaks,f)
		}
	}
}

function sneakUser(a,b,c) {
	if(c=="true") {
		notification_hide();
		bar.submenu("my_whoisneak",1);
		user_setBidsLeft(document.cookie.split(cookiePrefix+"bidsys_credits=")[1].split(";")[0])
	} else {
		if(document.getElementById("m_message")!=null) {
			if(document.getElementById("box_loading")!=null) {
				document.getElementById("m_message").innerHTML=document.getElementById("box_loading").innerHTML
			}
			ajax_asyncRequestField("pull/?cmd=sneakauser&target_username="+urlencode(a),ajax_getSneakValue,ajax_timeoutCancel,20000,b)
		}
	}
}

function sneakAuction(a,b) {
	if(b=="true") {
		notification_hide();
		bar.submenu("my_auction",2);
		user_setBidsLeft(document.cookie.split(cookiePrefix+"bidsys_credits=")[1].split(";")[0])
	} else {
		if(document.getElementById("m_message")!=null) {
			if(document.getElementById("prompt_loading")!=null) {
				document.getElementById("m_message").innerHTML=document.getElementById("prompt_loading").innerHTML
			}
			ajax_asyncRequestField("pull/?cmd=viewauctiondetails&auction_id="+urlencode(a),ajax_getSneakValue,ajax_timeoutCancel,20000,"moreinfo_auction_"+a)
		}
	}
}

function ajax_getSneakValue(a,b,d) {
	var c=b.responseText;
	if(document.getElementById("m_message")!=null) {
		if(c=="401") {
			notification_show(d,4)
		} else {
			document.getElementById("m_message").innerHTML=c
		}
	}
}

function element_foldUnfold(a) {
	if(a.parentNode!=null) {
		var b=a.parentNode;
		do {
			b=b.nextSibling
		} while(b&&b.nodeType!=1);
		if(a.className=="off") {
			b.style.display="block";
			a.className="on"
		} else {
			b.style.display="none";
			a.className="off"
		}
	}
}

function ie6_test() {
	var b=-1;
	if(navigator.appName=="Microsoft Internet Explorer") {
		var a=new RegExp("MSIE ([0-9]{1,}[.0-9]{0,})");
		if(a.exec(navigator.userAgent)!=null) {
			b=parseFloat(RegExp.$1)
		}
	}
	if((navigator.appName=="Microsoft Internet Explorer")&&(b<7)&&(ie6_readCookie("end6")!="1")) {
		prompt_showPage("pg_prompt_ie6");
		ie6_createCookie("end6",1,14400)
	}
}

function ie6_readCookie(d) {
	var f=d+"=";
	var a=document.cookie.split(";");
	for(var b=0;b<a.length;b++) {
		var e=a[b];
		while(e.charAt(0)==" ") {
			e=e.substring(1,e.length)
		}
		if(e.indexOf(f)==0) {
			return e.substring(f.length,e.length)
		}
	}
	return null
}

function ie6_createCookie(b,e,c) {
	var c=c;
	if(c) {
		var a=new Date();
		a.setTime(a.getTime()+(c*60*1000));var d="; expires="+a.toGMTString()
	} else {var d=""
	}
	document.cookie=b+"="+e+d+"; path=/"
}

window.onload=initDOM;