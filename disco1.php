<!DOCTYPE html>
<html>
  <head>
    <title>Colorful Gradient Background Animation</title>
    <style>
      body {
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
      }
    </style>
  </head>
  <body>
    <audio id="audio" src="http://x.ratetakeaway.com/1.mp3" controls></audio>
    <script>
      const colors = ["#f44336", "#e91e63", "#9c27b0", "#673ab7", "#3f51b5", "#2196f3", "#03a9f4", "#00bcd4", "#009688", "#4CAF50", "#8BC34A", "#CDDC39", "#FFEB3B", "#FFC107", "#FF9800", "#FF5722"];
      const numColors = colors.length;
      let colorIndex = 0;
      let gradientIndex = 0;
      let audioCtx = new (window.AudioContext || window.webkitAudioContext)();
      let audioSrc = audioCtx.createMediaElementSource(document.getElementById("audio"));
      let analyser = audioCtx.createAnalyser();
      audioSrc.connect(analyser);
      analyser.connect(audioCtx.destination);
      let bufferLength = analyser.frequencyBinCount;
      let dataArray = new Uint8Array(bufferLength);
      let frequencyData = 0;

      function setGradient() {
        let frequencyRange = 2000;
        analyser.getByteFrequencyData(dataArray);
        frequencyData = dataArray.reduce((a, b) => a + b) / bufferLength;
        let frequencyRatio = frequencyData / frequencyRange;
        let frequencyPercentage = frequencyRatio * 100;
        let color1 = colors[colorIndex];
        let color2 = colors[(colorIndex + 1) % numColors];
        let gradientDirection = gradientIndex % 2 == 0 ? "to right" : "to left";
        let gradient = `linear-gradient(${gradientDirection}, ${color1}, ${color2})`;
        document.body.style.background = gradient;
        document.body.style.transition = `background ${5 / frequencyRatio}s ease-in-out`;
        document.getElementById("audio").style.color = color1;
        colorIndex = (colorIndex + 1) % numColors;
        if (colorIndex === 0) {
          gradientIndex++;
        }
      }

      setGradient();
      setInterval(setGradient, 50);

      function handleInput(event) {
        let keyCode = event.keyCode;
        if (keyCode === 32) {
          if (document.getElementById("audio").paused) {
            document.getElementById("audio").play();
          } else {
            document.getElementById("audio").pause();
          }
        }
        if (keyCode === 38) {
          document.body.style.backgroundSize = `${parseInt(document.body.style.backgroundSize) + 10}%`;
        }
        if (keyCode === 40) {
          document.body.style.backgroundSize = `${parseInt(document.body.style.backgroundSize) - 10}%`;
        }
      }

      document.addEventListener("keydown", handleInput);
    </script>
  </body>
</html>
