/**
 * Created by Zerg on 27.01.2016.
 */
var subjectsNodes = [
    {
      title:"Нафтогаз",
      children:[
        {
          title: "Газотранспортна мережа",
          prj:"EPSG:0001",
          key:"gaz_line"
        },
        {
          title: "Газорозподільчі станції",
          prj:"EPSG:0001",
          key:"gaz_point"
        }
      ]
    },				{
      title:"Автодор",
      children:[
        {
          title:"Дороги",
          prj:"EPSG:0001",
          key:"road_warning"
        }
      ]
    },
    {
      title:"Каналізація",
      //isFolder:true,
      children:[
        {
          title: "Каналізаційна мережа",
          prj:"EPSG:0001",
          key:"network_sewerage"
        },
        {
          title: "Блоки очисних споруд та мулові поля",
          prj:"EPSG:0001",
          key:"seweragePoly"
        },
        {
          title: "Насосні станції каналізації",
          prj:"EPSG:0001",
          icon:"nasos_kanaliz.png",
          key:"pumping_station_sewerage"
        }
      ]
    },
    {
      title: "Водопостачання",
      children: [
        {
          title:"Мережа водопостачання" ,
          prj:"EPSG:0001",
          key:"network_water"
        },
        {
          title: "Насосні станції",
          prj:"EPSG:0001",
          icon:"nasos_vod.png",
          key:"pumping_station_water"
        },
        {
          title: "Задвижки",
          prj:"EPSG:0001",
          icon:"zadvijka.png",
          key:"shutter_water"
        },
        {
          title: "Заглушки",
          prj:"EPSG:0001",
          icon:"zaglushka.png",
          key:"stopper_water"
        }
      ]
    },
    {
      title: "Теплопостачання",
      children: [
        {
          title: "Тепломережа",
          prj:"EPSG:0001",
          key:"teplo_line"
        },
        {
          title: "Відключено",
          key:"vidkl"
        },
        {
          title: "Теплові джерела",
          prj:"EPSG:0001",
          icon:"teplozavod.png",
          key:"zavod_point"
        },
        {
          title: "Об\'єкти теплопостачання",
          prj:"EPSG:0001",
          icon:"rayon_kotelna.png",
          key:"stancii"
        }
      ]
    },
    {title: "Спеціальна інформація", isFolder: true,
      children: [
        {
          title: "Відділи МНС",
          icon:"mhc.png",
          prj:"EPSG:0001",
          key:"Viddilu_MNS"
        },
        {
          title: "DTP",
          prj:"EPSG:0001",
          icon:"mhc.png",
          key:"DTP_"
        },

        {
          title: "Відділи МВС",
          prj:"EPSG:0001",
          icon:"mvs.png",
          key:"MVS"
        },
        {
          title: "Зони відповідальності МВС",
          prj:"EPSG:0001",
          icon:"mvs.png",
          key:"MVD_zones"
        },
        {
          title:"Дільничні інспектори",
          prj:"EPSG:0001",
          icon:"ychastkoviy.png",
          key:"Inspectors"
        },
        {
          title: "СБУ",
          prj:"EPSG:0001",
          icon:"sbu.png",
          key:"sbu"
        },
        {
          title: "ДСО",
          icon:"dso.png",
          prj:"EPSG:0001",
          key:"DSO"
        },
        {
          title: "Пожежні частини",
          prj:"EPSG:0001",
          icon:"pojar.png",
          key:"Pojejka"
        },
        {
          title: "ЖЕКи",
          icon:"jek.png",
          prj:"EPSG:0001",
          key:"jek"
        },
        {
          title: "Гучномовці",
          icon:"gromkogovor.png",
          prj:"EPSG:0001",
          key:"loudspeaker"
        },
        {
          title: "Система оповіщення",
          prj:"EPSG:0001",
          icon:"voskl_znak.png",
          key:"warning"
        },
        {
          title: "Зони оповіщення",
          prj:"EPSG:0001",
          icon:"voskl_znak.png",
          key:"warning_zones"
        },
        {
          title: "Потенційно небезпечні об\'єкти",
          icon:"potential_35.png",
          prj:"EPSG:0001",
          key:"Prom_pred"
        },
        {
          title: "Захисні протиповеневі споруди",
          prj:"EPSG:0001",
          icon:"truba_most.jpg",
          key:"baryery_flood"
        }
      ]
    },
    {
      title:"Об\'єкти",
      isFolder:true,
      children:[
        {
          title: "Аеропорти та злітні смуги",
          icon:"aero.bmp",
          key:"airport"
        },
        {
          title: "Об\'єкти  Нацгвардії",
          icon:"natsgvardia.bmp",
          key:"natsgvardia"
        },
        {
          title: "Лінія",
          icon:"natsgvardia.bmp",
          key:"ato_border"
        },
        {
          title: "Буферна зона",
          icon:"natsgvardia.bmp",
          key:"ato_buffer"
        },
        {
          title: "Укриття",
          icon:"gromkogovor.png",
          key:"shovysha"
        },
        {
          title: "Test",
          icon:"rayon_kotelna.png",
          key:"layer_indastr_0"
        },
        {
          title: "Test",
          icon:"rayon_kotelna.png",
          key:"layer_indastr_1"
        },
        {
          title: "Test",
          icon:"rayon_kotelna.png",
          key:"layer_indastr_2"
        },
        {
          title: "Міста",
          icon:"nawigator.png",
          key:"city"
        }

      ]
    },
    {
      title:"Укрзалізниця",
      isFolder:true,
      children:[
        {
          title: "Залізниця",
          prj:"EPSG:0001",
          key:"railway"
        },
        {
          title: "Залізниця - детальна",
          prj:"EPSG:0001",
          key:"railway_detail"
        },
        {
          title: "Станції",
          prj:"EPSG:0001",
          cluster:true,
          icon:"gray_circle.png",
          key:"railway_point"
        }
      ]
    },
    {
      title:"Енергетика",
      children:[
        {
          title:"Київ",
          children:[
            {
              title:"Енергомережа" ,
              icon:"GAES.png",
              key:"energoline_new"
            },
            {
              title:"Підстанції єнергомережі" ,
              icon:"GES.png",
              cluster:true,
              key:"Podstancyi_new"
            }
          ]
        },
        {
          title: "Трансформатори",
          icon:"transformator20x20.png",
          cluster:true,
          key:"Transformator_new"
        }
        ,{
          title:"ЛЕП",
          icon:"GES.png",
          key:"LEP"
        }
        ,{
          title:"Підстанції",
          icon:"GES.png",
          cluster:true,
          key:"TP_Boryspil"
        }


      ]
    },
    {
      title:"Населення",
      isFolder:true,
      children:[
        {
          title: "Райони",
          key:"p_rayon"
        },
        {
          title: "Міськрада",
          key:"p_mkrada"
        },
        {
          title: "Місто",
          key:"p_misto"
        }
      ]
    }
];