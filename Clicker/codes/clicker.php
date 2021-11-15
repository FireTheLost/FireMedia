<?php
$title="Elemental Clicker";
include_once 'header.php';
?>

<script>
var elementName=["H","He"];

function setCost()
{
fusecost=Math.round(10*(1.18**Number(localStorage.fusecount)));
gencost=Math.round(850*(1.12**Number(localStorage.gencount)));
hnrcost=Math.round(10500*(1.14**Number(localStorage.hnrcount)));
ngrcost=Math.round(212000*(1.12**Number(localStorage.ngrcount)));

nukecost=Math.round(54500*(1.75**Number(localStorage.nukecount)));

hefcost=Math.round(100*(1.16**Number(localStorage.hefcount)));
cdcost=Math.round(500*(1.13**Number(localStorage.cdcount)));
hwdcost=Math.round(3300*(1.14**Number(localStorage.hwdcount)));

document.getElementById("fuse-cost").innerHTML="Cost: "+fusecost;
document.getElementById("gen-cost").innerHTML="Cost: "+gencost;
document.getElementById("hnr-cost").innerHTML="Cost: "+hnrcost;
document.getElementById("ngr-cost").innerHTML="Cost: "+ngrcost;

if(localStorage.nukecount>0)
{
  document.getElementById("hef-cost").innerHTML="Cost: "+hefcost;
  document.getElementById("cd-cost").innerHTML="Cost: "+cdcost;
  document.getElementById("hwd-cost").innerHTML="Cost: "+hwdcost;
}
if(Number(localStorage.nukecount)+1==elementName.length)
{
  nukebtn.disabled=true;
  nukebtn.style.cursor="no-drop";

  document.getElementById("nuclear-fusion-cost").innerHTML="All Elements Unlocked!";
}
else
{
  document.getElementById("nuclear-fusion-cost").innerHTML="Cost To Unlock "+elementName[Number(localStorage.nukecount)+1]+": "+nukecost;
}
}

window.onload = function() {
  var fusecost=Math.round(10*(1.18**Number(localStorage.fusecount)));
  var gencost=Math.round(750*(1.12**Number(localStorage.gencount)));
  var hnrcost=Math.round(7500*(1.14**Number(localStorage.hnrcount)));
  var ngrcost=Math.round(212000*(1.12**Number(localStorage.ngrcount)));

  var nukecost=Math.round(54500*(1.75**Number(localStorage.nukecount)));

  var hefcost=Math.round(100*(1.16**Number(localStorage.hefcount)));
  var cdcost=Math.round(500*(1.13**Number(localStorage.cdcount)));
  var hwdcost=Math.round(3300*(1.14**Number(localStorage.hwdcount)));

  if (localStorage.nukecount)
  {
    document.getElementById("nuclear-fusion-reactor-count").innerHTML=localStorage.nukecount+" Nuclear Fusion Reactor(s)";
  }
  else
  {
    localStorage.nukecount=0;
    document.getElementById("nuclear-fusion-reactor-count").innerHTML=localStorage.nukecount+" Nuclear Fusion Reactor(s)";
  }

  if (!(localStorage.hepersec))
  {
    localStorage.hepersec=3;
  }

  if (!(localStorage.hecount))
  {
    localStorage.hecount=0;
  }

  if (localStorage.hpersec)
  {
    document.getElementById("hydrogen-persec").innerHTML=localStorage.hpersec+" Hydrogen Atoms/Second";
  }
  else
  {
    localStorage.hpersec=0;
    document.getElementById("hydrogen-persec").innerHTML=localStorage.hcount+" Hydrogen Atoms/Second";
  }

  if (localStorage.hcount)
  {
    document.getElementById("hydrogen-count").innerHTML=localStorage.hcount+" Hydrogen Atoms";
  }
  else
  {
    localStorage.hcount=0;
    document.getElementById("hydrogen-count").innerHTML=localStorage.hcount+" Hydrogen Atoms";
  }

  if (localStorage.fusecount)
  {
    document.getElementById("fuse-num").innerHTML="Particle Fuser ("+localStorage.fusecount+")";
    document.getElementById("fuse-cost").innerHTML="Cost: "+fusecost;
  }
  else
  {
    localStorage.fusecount=0;
    document.getElementById("fuse-num").innerHTML="Particle Fuser ("+localStorage.fusecount+")";
    document.getElementById("fuse-cost").innerHTML=10;
  }

  if (localStorage.gencount)
  {
    document.getElementById("gen-num").innerHTML="Hydrogen Generator ("+localStorage.gencount+")";
    document.getElementById("gen-cost").innerHTML="Cost: "+gencost;
  }
  else
  {
    localStorage.gencount=0;
    document.getElementById("gen-num").innerHTML="Hydrogen Generator ("+localStorage.gencount+")";
    document.getElementById("gen-cost").innerHTML=750;
  }

  if (localStorage.hnrcount)
  {
    document.getElementById("hnr-num").innerHTML="Hydrogen Reactor ("+localStorage.hnrcount+")";
    document.getElementById("hnr-cost").innerHTML="Cost: "+hnrcost;
  }
  else
  {
    localStorage.hnrcount=0;
    document.getElementById("hnr-num").innerHTML="Hydrogen Reactor ("+localStorage.hnrcount+")";
    document.getElementById("hnr-cost").innerHTML=5000;
  }

  if (localStorage.ngrcount)
  {
    document.getElementById("ngr-num").innerHTML="Natural Gas Reformer ("+localStorage.ngrcount+")";
    document.getElementById("ngr-cost").innerHTML="Cost: "+ngrcost;
  }
  else
  {
    localStorage.ngrcount=0;
    document.getElementById("ngr-num").innerHTML="Natural Gas Reformer ("+localStorage.ngrcount+")";
    document.getElementById("ngr-cost").innerHTML=5000;
  }

if(localStorage.nukecount==0)
{
  if (!(localStorage.hefcount))
  {
    localStorage.hefcount=1;
  }

  if (!(localStorage.cdcount))
  {
    localStorage.cdcount=0;
  }
}
else
{
  if (localStorage.hefcount)
  {
    document.getElementById("hef-num").innerHTML="Helium Nuclear Reactor ("+localStorage.hefcount+")";
    document.getElementById("hef-cost").innerHTML="Cost: "+hefcost;
  }
  else
  {
    localStorage.hefcount=1;
    document.getElementById("hef-num").innerHTML="Helium Nuclear Reactor ("+localStorage.hefcount+")";
    document.getElementById("hef-cost").innerHTML=100;
  }

  if (localStorage.cdcount)
  {
    document.getElementById("cd-num").innerHTML="Cryogenic Distiller ("+localStorage.cdcount+")";
    document.getElementById("cd-cost").innerHTML="Cost: "+cdcost;
  }
  else
  {
    localStorage.cdcount=0;
    document.getElementById("cd-num").innerHTML="Cryogenic Distiller ("+localStorage.cdcount+")";
    document.getElementById("cd-cost").innerHTML=100;
  }

  if (localStorage.hwdcount)
  {
    document.getElementById("hwd-num").innerHTML="Helium Well Driller ("+localStorage.hwdcount+")";
    document.getElementById("hwd-cost").innerHTML="Cost: "+hwdcost;
  }
  else
  {
    localStorage.hwdcount=0;
    document.getElementById("hwd-num").innerHTML="Helium Well Driller ("+localStorage.hwdcount+")";
    document.getElementById("hwd-cost").innerHTML=100;
  }
}
};

window.setInterval(PFBtn, 10);
window.setInterval(HGBtn, 10);
window.setInterval(HNRBtn, 10);
window.setInterval(NGRBtn, 10);
window.setInterval(hPerSec, 1000);

window.setInterval(setCost, 10);
window.setInterval(buyNukeBtn, 10);

window.setInterval(showEle, 10);
window.setInterval(hePerSec, 1000);
window.setInterval(HEFBtn, 10);
window.setInterval(CDBtn, 10);
window.setInterval(HWDBtn, 10);

function showEle()
{
  switch (Number(localStorage.nukecount))
  {
    case 0:
      document.getElementById("hydrogen-count").innerHTML=localStorage.hcount+" Hydrogen Atoms";
      document.getElementById("hydrogen-persec").innerHTML=localStorage.hpersec+" Hydrogen Atoms/Second";
      break;

    case 1:
      document.getElementById("hydrogen-count").innerHTML=localStorage.hcount+" Hydrogen Atoms";
      document.getElementById("hydrogen-persec").innerHTML=localStorage.hpersec+" Hydrogen Atoms/Second";

      document.getElementById("helium-count").innerHTML=localStorage.hecount+" Helium Atoms";
      document.getElementById("helium-persec").innerHTML=localStorage.hepersec+" Helium Atoms/Second";
      break;  
  }
}

function clickCounter()
{
  localStorage.hcount = Number(localStorage.hcount)+1;

  document.getElementById("hydrogen-count").innerHTML=localStorage.hcount+" Hydrogen Atoms";
}

function buyNuke()
{
  localStorage.hcount=Number(localStorage.hcount)-nukecost;

  localStorage.nukecount=Number(localStorage.nukecount)+1;
  document.getElementById("nuclear-fusion-reactor-count").innerHTML=localStorage.nukecount+" Nuclear Fusion Reactor(s)";
}

function buyPF()
{
  localStorage.hcount=Number(localStorage.hcount)-fusecost;

  localStorage.fusecount=Number(localStorage.fusecount)+1;

  document.getElementById("fuse-num").innerHTML="Particle Fuser ("+localStorage.fusecount+")";
  document.getElementById("fuse-cost").innerHTML="Cost: "+fusecost;

  document.getElementById("hydrogen-count").innerHTML=localStorage.hcount+" Hydrogen Atoms";

  localStorage.hpersec=Number(localStorage.hpersec)+Math.round(0.15*(1.04**Number(localStorage.fusecount))+1);
  document.getElementById("hydrogen-persec").innerHTML=localStorage.hpersec+" Hydrogen Atoms/Second";
}

function buyHG()
{
  localStorage.hcount=Number(localStorage.hcount)-gencost;

  localStorage.gencount=Number(localStorage.gencount)+1;

  document.getElementById("gen-num").innerHTML="Hydrogen Generator ("+localStorage.gencount+")";
  document.getElementById("gen-cost").innerHTML="Cost: "+gencost;

  document.getElementById("hydrogen-count").innerHTML=localStorage.hcount+" Hydrogen Atoms";

  localStorage.hpersec=Number(localStorage.hpersec)+7;
  document.getElementById("hydrogen-persec").innerHTML=localStorage.hpersec+" Hydrogen Atoms/Second";
}

function buyHNR()
{
  localStorage.hcount=Number(localStorage.hcount)-hnrcost;

  localStorage.hnrcount=Number(localStorage.hnrcount)+1;

  document.getElementById("hnr-num").innerHTML="Hydrogen Reactor ("+localStorage.hnrcount+")";
  document.getElementById("hnr-cost").innerHTML="Cost: "+hnrcost;

  document.getElementById("hydrogen-count").innerHTML=localStorage.hcount+" Hydrogen Atoms";

  localStorage.hpersec=Number(localStorage.hpersec)+45;
  document.getElementById("hydrogen-persec").innerHTML=localStorage.hpersec+" Hydrogen Atoms/Second";
}

function buyNGR()
{
  localStorage.hcount=Number(localStorage.hcount)-ngrcost;

  localStorage.ngrcount=Number(localStorage.ngrcount)+1;

  document.getElementById("ngr-num").innerHTML="Natural Gas Reformer ("+localStorage.ngrcount+")";
  document.getElementById("ngr-cost").innerHTML="Cost: "+ngrcost;

  document.getElementById("hydrogen-count").innerHTML=localStorage.hcount+" Hydrogen Atoms";

  localStorage.hpersec=Number(localStorage.hpersec)+111;
  document.getElementById("hydrogen-persec").innerHTML=localStorage.hpersec+" Hydrogen Atoms/Second";
}

function buyHEF()
{
  localStorage.hecount=Number(localStorage.hecount)-hefcost;

  localStorage.hefcount=Number(localStorage.hefcount)+1;

  document.getElementById("hef-num").innerHTML="Helium Nuclear Reactor ("+localStorage.hefcount+")";
  document.getElementById("hef-cost").innerHTML="Cost: "+hefcost;

  document.getElementById("helium-count").innerHTML=localStorage.hecount+" Helium Atoms";

  localStorage.hepersec=Number(localStorage.hepersec)+3;
  document.getElementById("helium-persec").innerHTML=localStorage.hepersec+" Helium Atoms/Second";
}

function buyCD()
{
  localStorage.hecount=Number(localStorage.hecount)-cdcost;

  localStorage.cdcount=Number(localStorage.cdcount)+1;

  document.getElementById("cd-num").innerHTML="Cryogenic Distiller ("+localStorage.cdcount+")";
  document.getElementById("cd-cost").innerHTML="Cost: "+cdcost;

  document.getElementById("helium-count").innerHTML=localStorage.hecount+" Helium Atoms";

  localStorage.hepersec=Number(localStorage.hepersec)+9;
  document.getElementById("helium-persec").innerHTML=localStorage.hepersec+" Helium Atoms/Second";
}

function buyHWD()
{
  localStorage.hecount=Number(localStorage.hecount)-hwdcost;

  localStorage.hwdcount=Number(localStorage.hwdcount)+1;

  document.getElementById("hwd-num").innerHTML="Helium Well Driller ("+localStorage.hwdcount+")";
  document.getElementById("hwd-cost").innerHTML="Cost: "+hwdcost;

  document.getElementById("helium-count").innerHTML=localStorage.hecount+" Helium Atoms";

  localStorage.hepersec=Number(localStorage.hepersec)+25;
  document.getElementById("helium-persec").innerHTML=localStorage.hepersec+" Helium Atoms/Second";
}

function buyNukeBtn()
{
  var nukebtn=document.getElementById("nuke-btn");

  if(Number(localStorage.nukecount)+1==elementName.length)
  {
    nukebtn.disabled=true;
    nukebtn.style.cursor="no-drop";

    document.getElementById("nuclear-fusion-cost").innerHTML="All Elements Unlocked!";
  }
  else
  {
    if(nukecost>localStorage.hcount)
    {
      nukebtn.disabled=true;
      nukebtn.style.cursor="no-drop";
    }
    else
    {
      nukebtn.disabled=false;
      nukebtn.style.cursor="pointer";
    }
  }
}

function PFBtn()
{
  var fusebtn=document.getElementById("item-pf");

  if(fusecost>localStorage.hcount)
  {
    fusebtn.disabled=true;
  }
  else
  {
    fusebtn.disabled=false;
  }
}

function HGBtn()
{
  var genbtn=document.getElementById("item-hg");

  if(gencost>localStorage.hcount)
  {
    genbtn.disabled=true;
  }
  else
  {
    genbtn.disabled=false;
  }
}

function HNRBtn()
{
  var hnrbtn=document.getElementById("item-hnr");

  if(hnrcost>localStorage.hcount)
  {
    hnrbtn.disabled=true;
  }
  else
  {
    hnrbtn.disabled=false;
  }
}

function NGRBtn()
{
  var ngrbtn=document.getElementById("item-ngr");

  if(ngrcost>localStorage.hcount)
  {
    ngrbtn.disabled=true;
  }
  else
  {
    ngrbtn.disabled=false;
  }
}

function HEFBtn()
{
  var hefbtn=document.getElementById("item-hef");

  if(hefcost>localStorage.hecount)
  {
    hefbtn.disabled=true;
  }
  else
  {
    if((Number(localStorage.hepersec)+3)>Number(localStorage.hpersec))
    {
      hefbtn.disabled=true;
    }
    else
    {
      hefbtn.disabled=false;
    }
  }
}

function CDBtn()
{
  var cdbtn=document.getElementById("item-cd");

  if(cdcost>localStorage.hecount)
  {
    cdbtn.disabled=true;
  }
  else
  {
    if((Number(localStorage.hepersec)+9)>Number(localStorage.hpersec))
    {
      cdbtn.disabled=true;
    }
    else
    {
      cdbtn.disabled=false;
    }
  }
}
function HWDBtn()
{
  var hwdbtn=document.getElementById("item-hwd");

  if(hwdcost>localStorage.hecount)
  {
    hwdbtn.disabled=true;
  }
  else
  {
    if((Number(localStorage.hepersec)+25)>Number(localStorage.hpersec))
    {
      hwdbtn.disabled=true;
    }
    else
    {
      hwdbtn.disabled=false;
    }
  }
}

function hPerSec()
{
  if (localStorage.hpersec)
  {
    document.getElementById("hydrogen-persec").innerHTML=localStorage.hpersec+" Hydrogen Atoms/Second";
  }
  else
  {
    localStorage.hpersec=0;
    document.getElementById("hydrogen-persec").innerHTML=localStorage.hcount+" Hydrogen Atoms/Second";
  }

  if (localStorage.hcount)
  {
    document.getElementById("hydrogen-count").innerHTML=localStorage.hcount+" Hydrogen Atoms";
  }
  else
  {
    localStorage.hcount=0;
    document.getElementById("hydrogen-count").innerHTML=localStorage.hcount+" Hydrogen Atoms";
  }

  localStorage.hcount=Number(localStorage.hcount)+Number(localStorage.hpersec);
  document.getElementById("hydrogen-count").innerHTML=localStorage.hcount+" Hydrogen Atoms";
}

function hePerSec()
{
  if(Number(localStorage.nukecount)>0)
  {
    if (localStorage.hepersec)
    {
      document.getElementById("helium-persec").innerHTML=localStorage.hepersec+" Helium Atoms/Second";
    }
    else
    {
      localStorage.hepersec=3;
      document.getElementById("helium-persec").innerHTML=localStorage.hepersec+" Helium Atoms/Second";
    }

    if (localStorage.hecount)
    {
      document.getElementById("helium-count").innerHTML=localStorage.hecount+" Helium Atoms";
    }
    else
    {
      localStorage.hecount=0;
      document.getElementById("helium-count").innerHTML=localStorage.hecount+" Helium Atoms";
    }

    localStorage.hecount=Number(localStorage.hecount)+Number(localStorage.hepersec);
    document.getElementById("helium-count").innerHTML=localStorage.hecount+" Helium Atoms";

    localStorage.hcount=Number(localStorage.hcount)-Number(localStorage.hepersec);
    document.getElementById("hydrogen-count").innerHTML=localStorage.hcount+" Hydrogen Atoms";
  }
}

</script>

<div id="nuclear-fusion-reactor">
  <button id="nuke-btn" onclick="buyNuke()">
    <p id="nuclear-fusion-reactor-count"></p>
    <p id="nuclear-fusion-cost" style="font-size: 15px"></p>
  </button>
</div>

<br><br><br><br><br><br><br><br>
<div id="element-count">
  <div id="hydrogen-div">
    <p id="hydrogen-count"></p>
    <p id="hydrogen-persec" style="font-size: 15px"></p>
  </div>
  <div id="helium">
    <p id="helium-count"></p>
    <p id="helium-persec" style="font-size: 15px"></p>
  </div>
</div>

<center>
<div id="store">
<div id="h-store">
  <button class="item" id="item-pf" onclick="buyPF()">
    <p id="fuse-num"></p>
    <p id="fuse-cost"></p>
  </button>

  <button class="item" id="item-hg" onclick="buyHG()">
    <p id="gen-num"></p>
    <p id="gen-cost"></p>
  </button>

  <button class="item" id="item-hnr" onclick="buyHNR()">
    <p id="hnr-num"></p>
    <p id="hnr-cost"></p>
  </button>

  <button class="item" id="item-ngr" onclick="buyNGR()">
    <p id="ngr-num"></p>
    <p id="ngr-cost"></p>
  </button>
</div>

<hr>

<div id="he-store">
  <button class="item" id="item-hef" onclick="buyHEF()">
    <p id="hef-num"></p>
    <p id="hef-cost"></p>
  </button>

  <button class="item" id="item-cd" onclick="buyCD()">
    <p id="cd-num"></p>
    <p id="cd-cost"></p>

  <button class="item" id="item-hwd" onclick="buyHWD()">
    <p id="hwd-num"></p>
    <p id="hwd-cost"></p>
  </button>
</div>
</div>
</center>

<button id="hydrogen-container" onclick="clickCounter()"><img id="hydrogen" src="../images/Hydrogen.png"></button>

<?php
include_once 'footer.php';