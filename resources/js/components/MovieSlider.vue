<template>
  <div class="movie-slider">
    <div class="movie-slider-mask">
      <div class="slider-content">
        <span
          class="nav-left"
          tabindex="0"
          role="button"
          @click.prevent="moveCarousel(-1)"
          :disabled="atHeadOfList"
        >
          <b class="indicator-icon icon-leftCaret">Left</b>
        </span>

        <div class="slider-items-block" :style="{ transform: 'translateX' + '(' + currentOffset + 'px' + ')'}">
          <div class="slider-item" v-for="item in items">
            <img :src="item.image"/>
          </div>
        </div>

        <span
          class="nav-right"
          tabindex="0"
          role="button"
          @click.prevent="moveCarousel(1)"
          :disabled="atEndOfList"
        >
          <b class="indicator-icon icon-leftCaret">Right</b>
        </span>
      </div>
    </div>
  </div>
</template>

<script>

  export default {
    props: {
      //
    },

    mounted () {
      console.log('Mounted.')
    },

    computed: {
      atEndOfList() {
        return this.currentOffset <= (this.paginationFactor * -1) * (this.items.length - this.windowSize);
      },
      atHeadOfList() {
        return this.currentOffset === 0;
      },
    },

    data () {
      return {
        currentOffset: 2,
        windowSize: 3,
        paginationFactor: 1000,
        items: [
          {
            name: '',
            image: 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABalR_O5MYVZBSQpjJwlCDh_03z_Zgt2-JHcuA9VBoDrFmbcLwlixv6feh013hTPYLaH0wmEiVH85k0tGVo-0mnU72vJsnElC9PGh10oJ6B18brW5NAYRH6nHNy30.jpg?r=74e'
          },
          {
            name: '',
            image: 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABe4R29nj-vzYSnC7Q2NuOgaud2V_pqTdWMZgUddCKk5MAdTtpSYjBbV3i6AdK1H_f6fEQHwkS_SpUPkSyi-bDRcHxGF9zc6g.webp?r=ec2'
          },
          {
            name: '',
            image: 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABVJHApXhybZ71Cc3BSFr-7yBEoomb4dSi3wjAqagL0Rxelcq5SjsY975hki6ZMVRZ1zd4PEsp7-N1_HzzU7etwtQqa7R8sEc.webp?r=2ad'
          },
          {
            name: '',
            image: 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABfHH-hq7BDPD136zXqxmZec7amSePzoiFydl6iAPXWlzxjU3mgS30K1Gq6OK1KPQOvx3OLGqiDtSE3vTZjW4HOG9Gkp-J03P95PDMGM9FCSm3OxAVimWFuwXMzgg.jpg?r=cbc'
          },
          {
            name: '',
            image: 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABapZo49kfivTTKXSZrkjD0t56azqXyDeOlFetJBw7_S5Krxly0-ZPEEZuZSXeOqT1cjTYoDn8XdgBTm60aPq5UvOOO6BxPWP.webp?r=24b'
          },
          {
            name: '',
            image: 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABalR_O5MYVZBSQpjJwlCDh_03z_Zgt2-JHcuA9VBoDrFmbcLwlixv6feh013hTPYLaH0wmEiVH85k0tGVo-0mnU72vJsnElC9PGh10oJ6B18brW5NAYRH6nHNy30.jpg?r=74e'
          },
          {
            name: '',
            image: 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABe4R29nj-vzYSnC7Q2NuOgaud2V_pqTdWMZgUddCKk5MAdTtpSYjBbV3i6AdK1H_f6fEQHwkS_SpUPkSyi-bDRcHxGF9zc6g.webp?r=ec2'
          },
          {
            name: '',
            image: 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABVJHApXhybZ71Cc3BSFr-7yBEoomb4dSi3wjAqagL0Rxelcq5SjsY975hki6ZMVRZ1zd4PEsp7-N1_HzzU7etwtQqa7R8sEc.webp?r=2ad'
          },
          {
            name: '',
            image: 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABfHH-hq7BDPD136zXqxmZec7amSePzoiFydl6iAPXWlzxjU3mgS30K1Gq6OK1KPQOvx3OLGqiDtSE3vTZjW4HOG9Gkp-J03P95PDMGM9FCSm3OxAVimWFuwXMzgg.jpg?r=cbc'
          },
          {
            name: '',
            image: 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABapZo49kfivTTKXSZrkjD0t56azqXyDeOlFetJBw7_S5Krxly0-ZPEEZuZSXeOqT1cjTYoDn8XdgBTm60aPq5UvOOO6BxPWP.webp?r=24b'
          },
          {
            name: '',
            image: 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABalR_O5MYVZBSQpjJwlCDh_03z_Zgt2-JHcuA9VBoDrFmbcLwlixv6feh013hTPYLaH0wmEiVH85k0tGVo-0mnU72vJsnElC9PGh10oJ6B18brW5NAYRH6nHNy30.jpg?r=74e'
          },
          {
            name: '',
            image: 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABe4R29nj-vzYSnC7Q2NuOgaud2V_pqTdWMZgUddCKk5MAdTtpSYjBbV3i6AdK1H_f6fEQHwkS_SpUPkSyi-bDRcHxGF9zc6g.webp?r=ec2'
          },
          {
            name: '',
            image: 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABVJHApXhybZ71Cc3BSFr-7yBEoomb4dSi3wjAqagL0Rxelcq5SjsY975hki6ZMVRZ1zd4PEsp7-N1_HzzU7etwtQqa7R8sEc.webp?r=2ad'
          },
          {
            name: '',
            image: 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABfHH-hq7BDPD136zXqxmZec7amSePzoiFydl6iAPXWlzxjU3mgS30K1Gq6OK1KPQOvx3OLGqiDtSE3vTZjW4HOG9Gkp-J03P95PDMGM9FCSm3OxAVimWFuwXMzgg.jpg?r=cbc'
          },
          {
            name: '',
            image: 'https://occ-0-3467-3466.1.nflxso.net/dnm/api/v6/0DW6CdE4gYtYx8iy3aj8gs9WtXE/AAAABapZo49kfivTTKXSZrkjD0t56azqXyDeOlFetJBw7_S5Krxly0-ZPEEZuZSXeOqT1cjTYoDn8XdgBTm60aPq5UvOOO6BxPWP.webp?r=24b'
          }
        ]
      }
    },

    methods: {
      moveCarousel(direction) {
        console.log('CLICKED.')
        if (direction === 1 && !this.atEndOfList) {
          this.currentOffset -= this.paginationFactor;
        } else if (direction === -1 && !this.atHeadOfList) {
          this.currentOffset += this.paginationFactor;
        }
      }
    }
  }

</script>
