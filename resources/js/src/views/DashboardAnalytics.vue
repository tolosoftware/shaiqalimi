<template>
<div>
  <!-- {{userid}} -->
  <div class="vx-row mb-base">
    <div class="vx-col w-full md:w-1/3 lg:w-1/3 xl:w-1/3">
      <statistics-card-line class="md:mb-0 mb-base" icon="MonitorIcon" icon-right statistic="32476 AFN" statisticTitle="مصارف" :chartData="ordersRecevied.series" />
    </div>
    <div class="vx-col w-full md:w-1/3 lg:w-1/3 xl:w-1/3">
      <statistics-card-line class="md:mb-0 mb-base" icon="UserCheckIcon" icon-right statistic="1034567 AFN" statisticTitle="عواید" :chartData="ordersRecevied.series" color="success" />
    </div>
    <div class="vx-col w-full md:w-1/3 lg:w-1/3 xl:w-1/3">
      <statistics-card-line icon="MailIcon" icon-right statistic="76%" statisticTitle="میزان مفاد دهی" :chartData="ordersRecevied.series" color="warning" />
    </div>
  </div>
  <div class="vx-row">
    <!--<div class="vx-col w-full md:w-2/3 lg:w-3/4">
      <div class="vx-card mb-base">
        <div class="vx-card__header">
          <div class="vx-card__title">
            <h4 class="">گراف فروشات</h4>
          </div>
          <div class="vx-card__actions">
            <span class="feather-icon select-none relative">
              <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings w-6 h-6 text-grey">
                <circle cx="12" cy="12" r="3"></circle>
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
              </svg>
            </span>
          </div>
        </div>
        <div class="vx-card__collapsible-content vs-con-loading__container">
          <div class="p-6 pb-0" style="position: relative;">
            <div style="min-height: 281px;">
              <div id="apexcharts2xlp87gwg" class="apexcharts-canvas apexcharts2xlp87gwg apexcharts-theme-light" style="width: 850px; height: 266px;"><svg id="SvgjsSvg21371" width="850" height="266" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg apexcharts-zoomable hovering-zoom" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                  <g id="SvgjsG21373" class="apexcharts-inner apexcharts-graphical" transform="translate(45.9375, 30)">
                    <defs id="SvgjsDefs21372">
                      <clipPath id="gridRectMask2xlp87gwg">
                        <rect id="SvgjsRect21379" width="790.046875" height="202.98003125" x="-4" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                      </clipPath>
                      <clipPath id="gridRectMarkerMask2xlp87gwg">
                        <rect id="SvgjsRect21380" width="786.046875" height="202.98003125" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                      </clipPath>
                      <linearGradient id="SvgjsLinearGradient21385" x1="0" y1="1" x2="1" y2="1">
                        <stop id="SvgjsStop21386" stop-opacity="1" stop-color="rgba(223,135,242,1)" offset="0"></stop>
                        <stop id="SvgjsStop21387" stop-opacity="1" stop-color="rgba(115,103,240,1)" offset="1"></stop>
                        <stop id="SvgjsStop21388" stop-opacity="1" stop-color="rgba(115,103,240,1)" offset="1"></stop>
                        <stop id="SvgjsStop21389" stop-opacity="1" stop-color="rgba(223,135,242,1)" offset="1"></stop>
                      </linearGradient>
                      <filter id="SvgjsFilter21391" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%">
                        <feFlood id="SvgjsFeFlood21392" flood-color="#000000" flood-opacity="0.2" result="SvgjsFeFlood21392Out" in="SourceGraphic"></feFlood>
                        <feComposite id="SvgjsFeComposite21393" in="SvgjsFeFlood21392Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite21393Out"></feComposite>
                        <feOffset id="SvgjsFeOffset21394" dx="2" dy="20" result="SvgjsFeOffset21394Out" in="SvgjsFeComposite21393Out"></feOffset>
                        <feGaussianBlur id="SvgjsFeGaussianBlur21395" stdDeviation="6 " result="SvgjsFeGaussianBlur21395Out" in="SvgjsFeOffset21394Out"></feGaussianBlur>
                        <feMerge id="SvgjsFeMerge21396" result="SvgjsFeMerge21396Out" in="SourceGraphic">
                          <feMergeNode id="SvgjsFeMergeNode21397" in="SvgjsFeGaussianBlur21395Out"></feMergeNode>
                          <feMergeNode id="SvgjsFeMergeNode21398" in="[object Arguments]"></feMergeNode>
                        </feMerge>
                        <feBlend id="SvgjsFeBlend21399" in="SourceGraphic" in2="SvgjsFeMerge21396Out" mode="normal" result="SvgjsFeBlend21399Out"></feBlend>
                      </filter>
                    </defs>
                    <line id="SvgjsLine21378" x1="-0.5" y1="0" x2="-0.5" y2="198.98003125" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs apexcharts-active" x="-0.5" y="0" width="1" height="198.98003125" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line>
                    <g id="SvgjsG21400" class="apexcharts-xaxis" transform="translate(0, 0)">
                      <g id="SvgjsG21401" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText21403" x="0" y="227.98003125" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class=" text-grey fill-current">
                          <tspan id="SvgjsTspan21404" dir="rtl">Jan</tspan>
                          <title>Jan</title>
                        </text><text id="SvgjsText21406" x="71.09517045454547" y="227.98003125" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class=" text-grey fill-current">
                          <tspan id="SvgjsTspan21407" dir="rtl">Feb</tspan>
                          <title>Feb</title>
                        </text><text id="SvgjsText21409" x="142.1903409090909" y="227.98003125" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class=" text-grey fill-current">
                          <tspan id="SvgjsTspan21410">Mar</tspan>
                          <title>Mar</title>
                        </text><text id="SvgjsText21412" x="213.28551136363635" y="227.98003125" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class=" text-grey fill-current">
                          <tspan id="SvgjsTspan21413">Apr</tspan>
                          <title>Apr</title>
                        </text><text id="SvgjsText21415" x="284.38068181818176" y="227.98003125" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class=" text-grey fill-current">
                          <tspan id="SvgjsTspan21416">May</tspan>
                          <title>May</title>
                        </text><text id="SvgjsText21418" x="355.4758522727272" y="227.98003125" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class=" text-grey fill-current">
                          <tspan id="SvgjsTspan21419">Jun</tspan>
                          <title>Jun</title>
                        </text><text id="SvgjsText21421" x="426.57102272727263" y="227.98003125" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class=" text-grey fill-current">
                          <tspan id="SvgjsTspan21422">July</tspan>
                          <title>July</title>
                        </text><text id="SvgjsText21424" x="497.66619318181813" y="227.98003125" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class=" text-grey fill-current">
                          <tspan id="SvgjsTspan21425">Aug</tspan>
                          <title>Aug</title>
                        </text><text id="SvgjsText21427" x="568.7613636363636" y="227.98003125" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class=" text-grey fill-current">
                          <tspan id="SvgjsTspan21428">Sep</tspan>
                          <title>Sep</title>
                        </text><text id="SvgjsText21430" x="639.8565340909091" y="227.98003125" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class=" text-grey fill-current">
                          <tspan id="SvgjsTspan21431">Oct</tspan>
                          <title>Oct</title>
                        </text><text id="SvgjsText21433" x="710.9517045454546" y="227.98003125" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class=" text-grey fill-current">
                          <tspan id="SvgjsTspan21434">Nov</tspan>
                          <title>Nov</title>
                        </text><text id="SvgjsText21436" x="782.0468750000001" y="227.98003125" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class=" text-grey fill-current">
                          <tspan id="SvgjsTspan21437">Dec</tspan>
                          <title>Dec</title>
                        </text></g>
                    </g>
                    <g id="SvgjsG21452" class="apexcharts-grid">
                      <g id="SvgjsG21453" class="apexcharts-gridlines-horizontal">
                        <line id="SvgjsLine21455" x1="0" y1="0" x2="782.046875" y2="0" stroke="#ebebeb" stroke-dasharray="0" class="apexcharts-gridline"></line>
                        <line id="SvgjsLine21456" x1="0" y1="39.79600625" x2="782.046875" y2="39.79600625" stroke="#ebebeb" stroke-dasharray="0" class="apexcharts-gridline"></line>
                        <line id="SvgjsLine21457" x1="0" y1="79.5920125" x2="782.046875" y2="79.5920125" stroke="#ebebeb" stroke-dasharray="0" class="apexcharts-gridline"></line>
                        <line id="SvgjsLine21458" x1="0" y1="119.38801874999999" x2="782.046875" y2="119.38801874999999" stroke="#ebebeb" stroke-dasharray="0" class="apexcharts-gridline"></line>
                        <line id="SvgjsLine21459" x1="0" y1="159.184025" x2="782.046875" y2="159.184025" stroke="#ebebeb" stroke-dasharray="0" class="apexcharts-gridline"></line>
                        <line id="SvgjsLine21460" x1="0" y1="198.98003125" x2="782.046875" y2="198.98003125" stroke="#ebebeb" stroke-dasharray="0" class="apexcharts-gridline"></line>
                      </g>
                      <g id="SvgjsG21454" class="apexcharts-gridlines-vertical"></g>
                      <line id="SvgjsLine21462" x1="0" y1="198.98003125" x2="782.046875" y2="198.98003125" stroke="transparent" stroke-dasharray="0"></line>
                      <line id="SvgjsLine21461" x1="0" y1="1" x2="0" y2="198.98003125" stroke="transparent" stroke-dasharray="0"></line>
                    </g>
                    <g id="SvgjsG21381" class="apexcharts-line-series apexcharts-plot-series">
                      <g id="SvgjsG21382" class="apexcharts-series" seriesName="Sales" data:longestSeries="true" rel="1" data:realIndex="0">
                        <path id="SvgjsPath21390" d="M 0 167.14322625C 24.88330965909091 167.14322625 46.21186079545454 135.30642125 71.09517045454545 135.30642125C 95.97848011363637 135.30642125 117.30703125 159.184025 142.1903409090909 159.184025C 167.07365056818182 159.184025 188.40220170454546 115.408418125 213.28551136363637 115.408418125C 238.1688210227273 115.408418125 259.4973721590909 151.22482374999998 284.3806818181818 151.22482374999998C 309.2639914772727 151.22482374999998 330.5925426136364 43.775606874999994 355.4758522727273 43.775606874999994C 380.3591619318182 43.775606874999994 401.68771306818184 179.08202812499997 426.57102272727275 179.08202812499997C 451.45433238636366 179.08202812499997 472.7828835227273 75.61241187499999 497.6661931818182 75.61241187499999C 522.5495028409091 75.61241187499999 543.8780539772728 115.408418125 568.7613636363636 115.408418125C 593.6446732954546 115.408418125 614.9732244318182 35.81640562499999 639.8565340909091 35.81640562499999C 664.7398437500001 35.81640562499999 686.0683948863636 87.55121374999999 710.9517045454546 87.55121374999999C 735.8350142045455 87.55121374999999 757.1635653409091 43.775606874999994 782.046875 43.775606874999994" fill="none" fill-opacity="1" stroke="url(#SvgjsLinearGradient21385)" stroke-opacity="1" stroke-linecap="butt" stroke-width="4" stroke-dasharray="0" class="apexcharts-line" index="0" clip-path="url(#gridRectMask2xlp87gwg)" filter="url(#SvgjsFilter21391)" pathTo="M 0 167.14322625C 24.88330965909091 167.14322625 46.21186079545454 135.30642125 71.09517045454545 135.30642125C 95.97848011363637 135.30642125 117.30703125 159.184025 142.1903409090909 159.184025C 167.07365056818182 159.184025 188.40220170454546 115.408418125 213.28551136363637 115.408418125C 238.1688210227273 115.408418125 259.4973721590909 151.22482374999998 284.3806818181818 151.22482374999998C 309.2639914772727 151.22482374999998 330.5925426136364 43.775606874999994 355.4758522727273 43.775606874999994C 380.3591619318182 43.775606874999994 401.68771306818184 179.08202812499997 426.57102272727275 179.08202812499997C 451.45433238636366 179.08202812499997 472.7828835227273 75.61241187499999 497.6661931818182 75.61241187499999C 522.5495028409091 75.61241187499999 543.8780539772728 115.408418125 568.7613636363636 115.408418125C 593.6446732954546 115.408418125 614.9732244318182 35.81640562499999 639.8565340909091 35.81640562499999C 664.7398437500001 35.81640562499999 686.0683948863636 87.55121374999999 710.9517045454546 87.55121374999999C 735.8350142045455 87.55121374999999 757.1635653409091 43.775606874999994 782.046875 43.775606874999994" pathFrom="M -1 278.57204375L -1 278.57204375L 71.09517045454545 278.57204375L 142.1903409090909 278.57204375L 213.28551136363637 278.57204375L 284.3806818181818 278.57204375L 355.4758522727273 278.57204375L 426.57102272727275 278.57204375L 497.6661931818182 278.57204375L 568.7613636363636 278.57204375L 639.8565340909091 278.57204375L 710.9517045454546 278.57204375L 782.046875 278.57204375"></path>
                        <g id="SvgjsG21383" class="apexcharts-series-markers-wrap" data:realIndex="0">
                          <g class="apexcharts-series-markers">
                            <circle id="SvgjsCircle21468" r="5" cx="0" cy="167.14322625" class="apexcharts-marker wsy39x6sh no-pointer-events" stroke="#ffffff" fill="#df87f2" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle>
                          </g>
                        </g>
                      </g>
                      <g id="SvgjsG21384" class="apexcharts-datalabels" data:realIndex="0"></g>
                    </g>
                    <line id="SvgjsLine21463" x1="0" y1="0" x2="782.046875" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line>
                    <line id="SvgjsLine21464" x1="0" y1="0" x2="782.046875" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                    <g id="SvgjsG21465" class="apexcharts-yaxis-annotations"></g>
                    <g id="SvgjsG21466" class="apexcharts-xaxis-annotations"></g>
                    <g id="SvgjsG21467" class="apexcharts-point-annotations"></g>
                    <rect id="SvgjsRect21469" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-zoom-rect"></rect>
                    <rect id="SvgjsRect21470" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-selection-rect"></rect>
                  </g>
                  <rect id="SvgjsRect21377" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                  <g id="SvgjsG21438" class="apexcharts-yaxis" rel="0" transform="translate(15.9375, 0)">
                    <g id="SvgjsG21439" class="apexcharts-yaxis-texts-g"><text id="SvgjsText21440" x="20" y="31.5" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label text-grey fill-current">
                        <tspan id="SvgjsTspan21441">350</tspan>
                      </text><text id="SvgjsText21442" x="20" y="71.29600625" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label text-grey fill-current">
                        <tspan id="SvgjsTspan21443">300</tspan>
                      </text><text id="SvgjsText21444" x="20" y="111.09201250000001" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label text-grey fill-current">
                        <tspan id="SvgjsTspan21445">250</tspan>
                      </text><text id="SvgjsText21446" x="20" y="150.88801875000001" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label text-grey fill-current">
                        <tspan id="SvgjsTspan21447">200</tspan>
                      </text><text id="SvgjsText21448" x="20" y="190.68402500000002" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label text-grey fill-current">
                        <tspan id="SvgjsTspan21449">150</tspan>
                      </text><text id="SvgjsText21450" x="20" y="230.48003125000002" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label text-grey fill-current">
                        <tspan id="SvgjsTspan21451">100</tspan>
                      </text>
                    </g>
                  </g>
                  <g id="SvgjsG21374" class="apexcharts-annotations"></g>
                </svg>
                <div class="apexcharts-legend" style="max-height: 133px;"></div>
                <div class="apexcharts-tooltip apexcharts-theme-light apexcharts-active" style="left: 55.9375px; top: 169.643px;">
                  <div class="apexcharts-tooltip-series-group apexcharts-active" style="order: 1; display: flex;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(223, 135, 242);"></span>
                    <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                      <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label">Sales: </span><span class="apexcharts-tooltip-text-value">140</span></div>
                      <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                    </div>
                  </div>
                </div>
                <div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light apexcharts-active" style="left: 25.05px; top: 230.98px;">
                  <div class="apexcharts-xaxistooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; min-width: 23.0781px;">Jan</div>
                </div>
                <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                  <div class="apexcharts-yaxistooltip-text"></div>
                </div>
              </div>
            </div>
            <div class="resize-triggers">
              <div class="expand-trigger">
                <div style="width: 892px; height: 303px;"></div>
              </div>
              <div class="contract-trigger"></div>
            </div>
          </div>
        </div>
        <div class="vx-card__code-container collapsed" style="max-height: 0px; display: none;">
          <div class="code-content">
            <pre class="language-markup"><code class="language-markup"></code></pre>
          </div>
        </div>
      </div>
    </div> -->
    <div class="vx-col w-full md:w-2/3 lg:w-3/4 xl:w-3/4 mb-base">
      <vx-card title="گراف فروشات">
        <template slot="actions">
          <feather-icon icon="SettingsIcon" svgClasses="w-6 h-6 text-grey"></feather-icon>
        </template>
        <div slot="no-body" class="p-6 pb-0">
          <div class="flex" v-if="!revenueComparisonLine.analyticsData">
            <div class="mr-6">
              <p class="mb-1 font-semibold">فروشات امسال</p>
              <p class="text-3xl text-success"><sup class="text-base mr-1">$</sup>{{ revenueComparisonLine.analyticsData.thisMonth.toLocaleString() }}</p>
            </div>
            <div>
              <p class="mb-1 font-semibold">فروشات سال قبل</p>
              <p class="text-3xl"><sup class="text-base mr-1">$</sup>{{ revenueComparisonLine.analyticsData.lastMonth.toLocaleString() }}</p>
            </div>
          </div>
          <vue-apex-charts type="line" height="266" :options="analyticsData.revenueComparisonLine.chartOptions" :series="revenueComparisonLine.series" />
        </div>
      </vx-card>
    </div>
    <div class="vx-col w-full md:w-1/3 lg:w-1/4 xl:w-1/4 mb-base">
      <div class="vx-card">
        <!---->
        <div class="vx-card__collapsible-content vs-con-loading__container">
          <div class="p-8 clearfix">
            <div>
              <h1><sup class="text-lg">$</sup> <span>22,597</span></h1>
            </div>
            <p class="mt-2 mb-8 text-xl font-medium text-success">
              <span>+</span><span>5.2%</span><span class="ml-1">($956)</span>
            </p>
            <router-link to="/sales?tab=2">
              <vs-button icon-pack="feather" icon="icon-chevrons-left" icon-after class="shadow-md w-full lg:mt-0 mt-4">بررسی فروشات</vs-button>
            </router-link>
          </div>
          <div class="p-8 border d-theme-border-grey-light border-solid border-r-0 border-l-0 border-b-0">
            <div class="mb-4"><small>عواید: $56156</small>
              <div class="vs-progress--background vs-progress-success" style="height: 5px;">
                <div class="vs-progress--foreground" style="width: 50%;"></div>
                <!---->
              </div>
            </div>
            <div><small>مدت زمان: 2 سال</small>
              <div class="vs-progress--background vs-progress-warning" style="height: 5px;">
                <div class="vs-progress--foreground" style="width: 50%;"></div>
                <!---->
              </div>
            </div>
          </div>
          <!---->
          <!---->
        </div>
        <div class="vx-card__code-container collapsed" style="max-height: 0px; display: none;">
          <div class="code-content">
            <pre class="language-markup"><code class="language-markup"></code></pre>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="vx-row">
    <LatestProjects></LatestProjects>
  </div>
  <br>
  </vs-divider>
  <!--<ProjectList></ProjectList>-->
  <div class="vx-col w-full mb-base">
    <vx-card title="احصائیه معاملات تجارتی دریک سال مالی">
      <vue-apex-charts type="line" height="350" :options="apexChatData.mixedChart.chartOptions" :series="apexChatData.mixedChart.series"></vue-apex-charts>
      <!--<template slot="codeContainer">
        {{ apexChatData.mixedChartCode }}
      </template>-->
    </vx-card>
  </div>
</div>
</template>

<script>
import ECharts from 'vue-echarts/components/ECharts'
import 'echarts/lib/component/tooltip'
import 'echarts/lib/component/legend'
import 'echarts/lib/chart/line'
import theme from './theme.json'
import StatisticsCardLine from '@/components/statistics-cards/StatisticsCardLine.vue'
import VueApexCharts from 'vue-apexcharts'
import apexChatData from './apexChartData.js'

// import ProjectList from './apps/projects/proposals/ProposalList.vue' 
import LatestProjects from './apps/projects/LatestProjects.vue'
// import analyticsData from './analyticsData.js'
import analyticsData from './ui-elements/card/analyticsData.js'
import ChangeTimeDurationDropdown from '@/components/ChangeTimeDurationDropdown.vue'

ECharts.registerTheme('ovilia-green', theme)

export default {
  props: ["currentuser"],
  components: {
    ECharts,
    VueApexCharts,
    theme,
    StatisticsCardLine,
    // ProjectList
    LatestProjects
  },
  name: 'vx-dashboard',
  data() {
    return {
      userid: localStorage.getItem('id'),
      apexChatData,
      analyticsData,
      revenueComparisonLine: {
        series: [{
            name: "ماه جاری",
            data: [45000, 47000, 44800, 47500, 45500, 48000, 46500, 48600]
          },
          {
            name: "ماه قبل",
            data: [46000, 48000, 45500, 46600, 44500, 46500, 45000, 47000]
          }
        ],
        chartOptions: {
          chart: {
            toolbar: {
              show: false
            },
            dropShadow: {
              enabled: true,
              top: 5,
              left: 0,
              blur: 4,
              opacity: 0.10
            }
          },
          stroke: {
            curve: 'smooth',
            dashArray: [0, 8],
            width: [4, 2]
          },
          grid: {
            borderColor: '#e7e7e7'
          },
          legend: {
            show: false
          },
          colors: ['#F97794', '#b8c2cc'],
          fill: {
            type: 'gradient',
            gradient: {
              shade: 'dark',
              inverseColors: false,
              gradientToColors: ['#7367F0', '#b8c2cc'],
              shadeIntensity: 1,
              type: 'horizontal',
              opacityFrom: 1,
              opacityTo: 1,
              stops: [0, 100, 100, 100]
            }
          },
          markers: {
            size: 0,
            hover: {
              size: 5
            }
          },
          xaxis: {
            labels: {
              style: {
                cssClass: 'text-grey fill-current'
              }
            },
            axisTicks: {
              show: false
            },
            categories: ['01', '05', '09', '13', '17', '21', '26', '31'],
            axisBorder: {
              show: false
            }
          },
          yaxis: {
            tickAmount: 5,
            labels: {
              style: {
                cssClass: 'text-grey fill-current'
              },
              formatter(val) {
                return val > 999 ? `${(val / 1000).toFixed(1)}k` : val
              }
            }
          },
          tooltip: {
            x: {
              show: false
            }
          }
        },
        analyticsData: {
          thisMonth: '73683',
          lastMonth: '86589'
        }
      },
      // Line Charts
      siteTraffic: {},

      activeUsers: {
        series: [{
          name: 'Users',
          data: [60, 15, 58, 15, 74, 42, 82]
        }],
        analyticsData: {
          users: 97500
        }
      },

      ordersRecevied: {
        series: [{
          name: 'روز قبل',
          data: [60, 15, 58, 15, 74, 42, 82]
        }],
        analyticsData: {
          orders: 97500
        }
      },

      newsletter: {}

    }

  },

  created() {
  // console.log(this.$parent);
    // Support Tracker
    this.$http.get('/api/card/card-analytics/support-tracker')
      .then((response) => {
        this.supportTracker = response.data
      })
      .catch((error) => {
      // console.log(error)
      })

    // Active Users
    this.$http.get('/api/card/card-statistics/active-users')
      .then((response) => {
        this.activeUsers = response.data
      })
      .catch((error) => {
      // console.log(error)
      })
    // Site Traffic gained
    this.$http.get('/api/card/card-statistics/newsletter')
      .then((response) => {
        this.newsletter = response.data
      })
      .catch((error) => {
      // console.log(error)
      })

    // Start the Progress Bar
    this.$Progress.start()
    this.$vs.loading({
      type: 'border',
      color: '#432e81',
    });
    setTimeout(() => {
      this.$vs.loading.close()
      this.$Progress.set(95)
    }, 2000)
  },
}
</script>

<style>
.projectListDashboard {
  display: flex;
  width: 100%;
  background-color: rgb(243, 245, 247);
  border-left-width: 0.6rem;
  border-left-style: solid;
  padding: 10px;
  border-color: rgb(49, 47, 75) !important;
}
</style>
