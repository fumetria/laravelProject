<template>
    <div
      class="spinner"
      :style="spinnerStyle"
    ></div>
  </template>
  
  <script>
  export default {
    name: 'Spinner',
    props: {
      size: {
        type: String,
        default: '56px'
      },
      color: {
        type: String,
        default: '#474bff'
      },
      speed: {
        type: String,
        default: '1s'
      }
    },
    computed: {
      spinnerStyle() {
        return {
          width: this.size,
          height: this.size,
          background: `conic-gradient(#0000 10%, ${this.color})`,
          WebkitMask: 'radial-gradient(farthest-side, #0000 calc(100% - 9px), #000 0)',
          mask: 'radial-gradient(farthest-side, #0000 calc(100% - 9px), #000 0)',
          animation: `spinner-rotate ${this.speed} infinite linear`,
          borderRadius: '50%'
        };
      }
    }
  }
  </script>
  
  <style scoped>
  @keyframes spinner-rotate {
    to {
      transform: rotate(1turn);
    }
  }
  </style>
  