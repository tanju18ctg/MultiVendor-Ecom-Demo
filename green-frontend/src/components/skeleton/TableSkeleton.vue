<template>
  <div>
    <table class="tg">
      <tr>
        <th class="tg-cly1">
          <div class="line"></div>
        </th>
        <th class="tg-cly1">
          <div class="line"></div>
        </th>
        <th class="tg-cly1">
          <div class="line"></div>
        </th>
        <th class="tg-cly1">
          <div class="line"></div>
        </th>
        <th class="tg-cly1">
          <div class="line"></div>
        </th>
        <th class="tg-cly1">
          <div class="line"></div>
        </th>
      </tr>
      <tr>
        <td class="tg-cly1">
          <div class="line"></div>
        </td>
        <td class="tg-cly1">
          <div class="line"></div>
        </td>
        <td class="tg-cly1">
          <div class="line"></div>
        </td>
        <td class="tg-cly1">
          <div class="line"></div>
        </td>
        <td class="tg-cly1">
          <div class="line"></div>
        </td>
        <td class="tg-cly1">
          <div class="line"></div>
        </td>
      </tr>

      <tr>
        <td class="tg-cly1">
          <div class="line"></div>
        </td>
        <td class="tg-cly1">
          <div class="line"></div>
        </td>
        <td class="tg-cly1">
          <div class="line"></div>
        </td>
        <td class="tg-cly1">
          <div class="line"></div>
        </td>
        <td class="tg-cly1">
          <div class="line"></div>
        </td>
        <td class="tg-cly1">
          <div class="line"></div>
        </td>
      </tr>

      <tr>
        <td class="tg-cly1">
          <div class="line"></div>
        </td>
        <td class="tg-cly1">
          <div class="line"></div>
        </td>
        <td class="tg-cly1">
          <div class="line"></div>
        </td>
        <td class="tg-cly1">
          <div class="line"></div>
        </td>
        <td class="tg-cly1">
          <div class="line"></div>
        </td>
        <td class="tg-cly1">
          <div class="line"></div>
        </td>
      </tr>

     
    </table>
  </div>
</template>
<script>
export default {}; 
</script>
<style scoped>
body {
  margin: 0;
}

.container {
  height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.tg {
  border-collapse: collapse;
  border-spacing: 0;
  border-color: #ccc;
}

.tg td {
  font-family: Arial, sans-serif;
  font-size: 14px;
  padding: 10px 5px;
  border-style: solid;
  border-width: 0px;
  overflow: hidden;
  word-break: normal;
  border-color: #ccc;
  color: #333;
  background-color: #fff;
}

.tg th {
  font-family: Arial, sans-serif;
  font-size: 14px;
  font-weight: normal;
  padding: 10px 5px;
  border-style: solid;
  border-width: 0px;
  overflow: hidden;
  word-break: normal;
  border-color: #ccc;
  color: #333;
  background-color: #f0f0f0;
}

.line {
  float: left;
  width: 180px;
  height: 30px;
  margin-top: 12px;
  border-radius: 7px;
  background-image: linear-gradient(
    90deg,
    #f4f4f4 0px,
    rgba(229, 229, 229, 0.8) 40px,
    #f4f4f4 80px
  );
  background-size: 600px;
  animation: shine-lines 2s infinite ease-out;
}

@keyframes shine-lines {
  0% {
    background-position: -100px;
  }
  40%,
  100% {
    background-position: 140px;
  }
}
</style>
