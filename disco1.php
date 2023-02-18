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
    <script>
      const colors = ["#f44336", "#e91e63", "#9c27b0", "#673ab7", "#3f51b5", "#2196f3", "#03a9f4", "#00bcd4", "#009688", "#4CAF50", "#8BC34A", "#CDDC39", "#FFEB3B", "#FFC107", "#FF9800", "#FF5722"];
      const numColors = colors.length;
      let colorIndex = 0;
      let gradientIndex = 0;

      function setGradient() {
        document.body.style.background = "linear-gradient(to right, " + colors[colorIndex] + ", " + colors[(colorIndex + 1) % numColors] + ")";
        colorIndex = (colorIndex + 1) % numColors;
        if (colorIndex === 0) {
          gradientIndex = (gradientIndex + 1) % 360;
        }
      }

      setGradient();
      setInterval(setGradient, 50);
    </script>
  </body>
</html>
