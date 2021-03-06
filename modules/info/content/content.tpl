<div class="module">
  <div class="module-content">
    <div class="ui segment markdown">
      <div id="--" class="anchor-wrap"><h2>Формат файлу оточення<a class="anchor" href="#--"><span class="octicon octicon-link"></span></a></h2></div>

      <p><b>Приклад файлу оточення:</b></p>
      <p>20.17541308822119
        0.00000000000000
        0.00000000000000
        -20.17541308822119
        424178.11472601280548
        4313415.90726399607956</p>

      <p><b>Роз'яснення:</b></p>

      <p>Тут вказано, що являють цi шiсть параметрiв (цi параметри повиннi бути у файлi тiльки в такому порядку):
        20.17541308822119 Розмiр пiкселя у одиницях мапи по осi х (x-мiрило).
        0.00000000000000 Значення повороту для рядка
        0.00000000000000 Значення повороту для стовпчика
        -20.17541308822119 Розмiр пiкселя в одиницях мапи по осi y (y-мiрило).
        424178.11472601280548 Координата х в одиницях мапи центра верхнього лiвого пiкселя
        4313415.90726399607956 Координата у в одиницях мапи центра верхнього лiвого пiкселя</p>

      <p>Звернiть увагу, що у-мiрило представляє величину х-мiрила, яка була взята з вiд'ємним знаком. Це зроблено, щоб врахувати рiзницю мiж оригiналом зображення та даними не-зображення. Перетворення вiд системи координат зображення до свiтової системи, яке використовує ArcView, є аффінним перетворенням, яке грунтується на шести параметрах. Якщо Ви бажаєте подивитись формули, якi використовує ArcView, знайдiть "world files" у списку iнтерактивної довiдкової iнформацiї.</p>

      <p>Зауваження. ArcView не повертає (викривлює) зображення, коли воно перетворюється у реальнi земнi координати. Якщо iнформацiя про географiчну прив'язку мiстить вiдмiнне вiд нуля визначення повороту, ArcView обчислює бiльший географiчний екстент для зображення з врахуванням повороту, щоб розташувати зображення у цьому новому екстентi без обертання, тому що працювати з зображенням зручнiше, якщо воно не повернуто або повернуто на дуже малий кут.</p>

      <p>Iм'я World file, яке прийняте за згодою
        Файл оточення (World file) зображення використовує те ж саме iм'я, що й само зображення, але з додаванням "w". Наприклад, файл оточення (world file) зображення з iм'ям mytown.tiff буде названий mytown.tiffw.
        Для iменування, прийнятого за згодою у MS-DOS 8.3, правила трохи вiдрiзняються. У якостi розширення iм'я файла оточення (world file) використовується перший та останнiй символ розширення iм'я зображення плюс символ "w". Тому mytown.tif буде мати файл оточення (world file) з назвою mytown.tfw; redlands.rlc - redlands.rcw.
        Для зображень без розширення або з розширенням, яке має менше трьох символiв, "w" просто додається. Файл оточення (world file) для зображення мiсцевостi буде називатися terrainw, для файла зображення floorpln.rs - floorpln.rsw.
        Замiсть наведених вище правил для файлiв оточення (world files) може використовуватись розширення .wld.</p>

    </div>

  </div>
</div>
</div>