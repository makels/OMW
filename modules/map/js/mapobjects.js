MAPOBJECT = OpenLayers.Class({
    vector:null,
    script:"/ajax/map_objects",
    div:"",
    hControl:false,
    //Data section
    ajax:null,
    init:null,
    dataExec:function () {
        if (this.readyState == 4)
        {
            var i=0;
        }
        
    },
    dataType:'json',
    req:"GET",
    data:{},
    
    //
    type:"",
    tabs:[],
    id:"",
    extent:null,
    start:0,
    end:1000,
    initialize:function(options) {
        OpenLayers.Util.extend(this, options);
        if(this.id=="")this.id=OpenLayers.Util.createUniqueID("MAPOBJECT_");
        switch(this.type)
        {
            case "tree":
            
            break;
            default:
            
            break;
        }
        if(this.init)
        {
            this.init();
        }
    },
    update:function(extent,zoom)
    {
        
    },
    send:function(extent,zoom)
    {
        if(zoom>=this.start && zoom<this.end)
        {
            if(this.ajax)
            {
                this.ajax.abort();
                this.ajax.responseJS=null;
            }
            this.ajax = new JsHttpRequest();
            this.ajax.onreadystatechange=this.dataExec;
            this.ajax.open(this.req, this.script , true);
            this.ajax.send(this.data);  
            
        }
    },
    forextent:function(extent)
    {
    
    },
    deleteObject:function()
    {
        
        delete this.vector;
        this.vector=null;
        delete this.ajax;
        this.ajax=null;
        delete this.extent;
        this.extent=null;
    },
    CLASS_NAME: "MAPOBJECT"
});



MAPOBJECTS = OpenLayers.Class({
    objects:[],
    scripts:[],
    hControl:null,
    map:null,
    initialize:function(options) {
        
        OpenLayers.Util.extend(this, options);
        var allScriptTags = new Array(this.scripts.length);
        var h = document.getElementsByTagName("head").length?document.getElementsByTagName("head")[0]:document.body;
        for(var i=0,N=this.scripts.length;i<N;i++)
        {
            allScriptTags[i] = "<script src='" + this.scripts[i] +" type='text/javascript'></script>";
            h.appendChild(s);
        }
        var layersArr=[];
        
        
        for(var i=0,N=this.objects.length;i<N;i++)
        {
            if(this.objects[i].hControl)layersArr.push(this.objects[i].vector);
        }
        delete layersArr; 
        layersArr=null;
        
        
        delete allScriptTags;
        allScriptTags=null;
        delete h;
        h=null;
        
    },
    
    mousedown:function(evt)
    {
    
    switch(evt.attributes.type)
    {
    case "DTP":
        var wnd=evt.attributes.wndObj.wnd;
        var cont=evt.attributes.wndObj.loadContent;
        $('#'+cont).text("");
        $("#"+wnd).dialog("open");
    break;
    default:
        var i=0;
        var str="";
        var state=evt.attributes.wndST;
        if(state)
        {
        var wnd=evt.attributes.wndObj.wnd;
        var cont=evt.attributes.wndObj.loadContent;
        var p=$("#"+wnd).dialog( "option", "ctrl").point;
        if(p!=null)
        {
            var pointFeature=new OpenLayers.Feature.Vector(p);
            evt.attributes.wndObj.layer.eraseFeatures([pointFeature]);
            $("#"+wnd).dialog( "option", "ctrl").point=null;
        }        
        str+="<b> "+evt.attributes.title+"</b><br>";
        $('#'+cont).text("");
        if(evt.attributes.iFile!="")
        {
            str+="<img src='"+pathMainPRG+"image/full/"+evt.attributes.iFile+"' width=250 height=250/><br>";
        }
        if(isset(evt.attributes.content))
        {
            var contnent="";
            switch(typeof(evt.attributes.content))
            {
                case 'string':
                    //evt.attributes.contDiv=cont;
                    if(typeof(evt.attributes.func)!='undefined')str+=evt.attributes.func(evt);
                    else str+="";
                    
                break;
                default:
                    content="";
                    content+="<ul id='myList'>";
                    for(var key in evt.attributes.content)
                    {
                        content+="<li style=\"border:double; \"><a href=\"#\"' id=\"G"+evt.attributes.id[key]+"\" onclick=\"windowPoiSelect(this);\" table=\""+evt.attributes.table+"\">"+evt.attributes.content[key]+"</a>";
                        content+="<div id='T"+evt.attributes.id[key]+"'></div></li>";
                    }
                    str+=content+"<br/>";
                break;
            }
        }
        var p=evt.geometry.clone();
        if(evt.attributes.group)
        {
        }else
        {
            evt.attributes.wndObj.addMarker(p,"image/icons/select.png",{title:"",backgroundGraphic:"",favColor:"red",backWidth:15,backHeight:15,imgHeight:29,imgWidth:29,align: "ct",iFile:"",content:"",group:false,wndST:false,popupST:false});
            $("#"+wnd).dialog( "option", "ctrl").point=p;
        }
        $('#'+cont).append(str);
        if($("#myList").get().length>0)
        {
            $("#myList").attr('wnd',wnd);
        }        
        $("#"+wnd).dialog("open");
        break;
        }            
    }
        OpenLayers.Event.stop(evt);
    },
    
    clasterPopup:function(evt)
    {
    if(evt.attributes.popupST)
    {
        if(typeof(evt.attributes.type)=='undefined')evt.attributes.type='point';
        evt.attributes.popup.hide();
        var cont="";
        
        switch(evt.attributes.type)
        {
            case "point":
                $('#'+evt.geometry.id).css('border','3px solid #00a8e1');
                evt.attributes.popup.lonlat.lon=evt.geometry.x;
                evt.attributes.popup.lonlat.lat=evt.geometry.y;
            break;
            case 'polygon':case "line":
                var lonlat=map.getLonLatFromViewPortPx(M_Position.lastXy);
                evt.attributes.popup.lonlat.lon=lonlat.lon;
                evt.attributes.popup.lonlat.lat=lonlat.lat;
            break;
            case "line":
            
            break;
            default:
                
            break;
        }
        evt.attributes.popup.updatePosition();
        
        str="<div width='250px' height='250px'>";
        str+="<b> "+evt.attributes.title+"</b><br>";

        switch(typeof(evt.attributes.content))
        {
            case "string":
                //str+=evt.attributes.content;
            break;
            case "array":case "object":
                for(var key in evt.attributes.content)
                {
                    var i=0;
                    cont+=evt.attributes.content[key]+"<br>";
                }
                if(evt.attributes.group)str+=cont;
            break;
            default:
                
            break;
        }

        str+="</div>";
        evt.attributes.popup.setContentHTML(str);
        evt.attributes.popup.updateSize();
        evt.attributes.popup.show();
        this.unselectAll();
    }
    else if($("#railway_road").get().length>0||$("#POI_road").get().length>0)//if railway is defined
    {
        //POI_road
        var lonlat=map.getLonLatFromViewPortPx(M_Position.lastXy);
        evt.attributes.popup.lonlat.lon=lonlat.lon;
        evt.attributes.popup.lonlat.lat=lonlat.lat;
        switch(typeof(evt.attributes.content))
        {
            case "string":
                var str=evt.attributes.title+"<br>"+evt.attributes.content;
                evt.attributes.popup.setContentHTML(str);
                evt.attributes.popup.updateSize();
                evt.attributes.popup.updatePosition();
            break;
            case "array":
                
            break;
            default:
                
            break;
        }
    }
    OpenLayers.Event.stop(evt);
    },
    addObject:function(obj)
    {
        if(typeof(obj.id)!="undefined"&&obj.id!=null)
        {
            this.objects[obj.name]=obj;  
        }
    },
    update:function(extent,zoom)
    {
        for(var i=0,N=this.objects.length;i<N;i++)
        {
            this.objects[i].send(extent,zoom);
        }
    },
    deleteObject:function(name)
    {
        this.objects[name].deleteObject();
        delete this.objects[name];
        this.objects[name]=null;
    },
    CLASS_NAME: "MAPOBJECTS"
});