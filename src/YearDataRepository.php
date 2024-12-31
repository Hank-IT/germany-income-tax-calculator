<?php

declare(strict_types=1);

namespace HankIT\GermanyIncomeTaxCalculator;

use HankIT\GermanyIncomeTaxCalculator\Dtos\Zone1ExemptDto;
use HankIT\GermanyIncomeTaxCalculator\Dtos\Zone2ProgressiveOneDto;
use HankIT\GermanyIncomeTaxCalculator\Dtos\Zone3ProgressiveTwoDto;
use HankIT\GermanyIncomeTaxCalculator\Dtos\Zone4TopRateDto;
use HankIT\GermanyIncomeTaxCalculator\Dtos\Zone5WealthRateDto;

return [
    // 2024-12-31
    2016 => [
        new Zone1ExemptDto(8652.00),
        new Zone2ProgressiveOneDto(8653.00, 13669.00, 993.62),
        new Zone3ProgressiveTwoDto(13670.00, 53665.00, 225.4, 952.48),
        new Zone4TopRateDto(53666.00, 254446.00, 8394.14),
        new Zone5WealthRateDto(254447.00, 16027.52),
    ],

    // 2024-12-31
    2017 => [
        new Zone1ExemptDto(8820.00),
        new Zone2ProgressiveOneDto(8821.00, 13769.00, 1007.27),
        new Zone3ProgressiveTwoDto(13770.00, 54057.00, 223.76, 939.57),
        new Zone4TopRateDto(54058.00, 256303.00, 8475.44),
        new Zone5WealthRateDto(256304.00, 16164.53),
    ],

    // 2024-12-31
    2018 => [
        new Zone1ExemptDto(9000.00),
        new Zone2ProgressiveOneDto(9001.00, 13996.00, 997.80),
        new Zone3ProgressiveTwoDto(13997.00, 54949.00, 220.13, 948.49),
        new Zone4TopRateDto(54950.00, 260532.00, 8621.75),
        new Zone5WealthRateDto(260533.00, 16437.70),
    ],

    // 2024-12-31
    2019 => [
        new Zone1ExemptDto(9168.00),
        new Zone2ProgressiveOneDto(9169.00, 14254.00, 980.14),
        new Zone3ProgressiveTwoDto(14255.00, 55960.00, 216.16, 965.58),
        new Zone4TopRateDto(55961.00, 265326.00, 8780.90),
        new Zone5WealthRateDto(265327.00, 16740.70),
    ],

    // 2024-12-31
    2020 => [
        new Zone1ExemptDto(9408.00),
        new Zone2ProgressiveOneDto(9409.00, 14532.00, 972.87),
        new Zone3ProgressiveTwoDto(14533.00, 57051.00, 212.02, 972.79),
        new Zone4TopRateDto(57052.00, 270500.00, 8963.74),
        new Zone5WealthRateDto(270501.00, 17078.74),
    ],

    // 2024-12-31
    2021 => [
        new Zone1ExemptDto(9744.00),
        new Zone2ProgressiveOneDto(9745.00, 14753.00, 995.21),
        new Zone3ProgressiveTwoDto(14754.00, 57918.00, 208.85, 950.96),
        new Zone4TopRateDto(57919.00, 274612.00, 9136.63),
        new Zone5WealthRateDto(274613, 17374.99),
    ],

    // 2024-12-31
    2022 => [
        new Zone1ExemptDto(10347),
        new Zone2ProgressiveOneDto(10348, 14926, 1088.67),
        new Zone3ProgressiveTwoDto(14927.00, 58596, 206.435, 869.32),
        new Zone4TopRateDto(58597, 277825, 9336.45),
        new Zone5WealthRateDto(277826, 17671.20),
    ],

    // 2024-12-31
    2023 => [
        new Zone1ExemptDto(10908),
        new Zone2ProgressiveOneDto(10909, 15999, 979.18),
        new Zone3ProgressiveTwoDto(16000.00, 62809, 192.59, 966.53),
        new Zone4TopRateDto(62810.00, 277825.00, 9972.98),
        new Zone5WealthRateDto(277826, 18307.73),
    ],

    // 2024-12-31
    2024 => [
        new Zone1ExemptDto(11784),
        new Zone2ProgressiveOneDto(11785, 17005, 954.80),
        new Zone3ProgressiveTwoDto(17006.00, 66760, 181.19, 991.21),
        new Zone4TopRateDto(66761.00, 277825, 10636.31),
        new Zone5WealthRateDto(277826, 18971.06),
    ],

    // 2024-12-31
    2025 => [
        new Zone1ExemptDto(12096),
        new Zone2ProgressiveOneDto(12097, 17443, 932.30),
        new Zone3ProgressiveTwoDto(17444, 68480, 176.64, 1015.13),
        new Zone4TopRateDto(68481, 277825, 10911.92),
        new Zone5WealthRateDto(277826, 19246.67),
    ],

    // 2024-12-31
    2026 => [
        new Zone1ExemptDto(12348),
        new Zone2ProgressiveOneDto(12349, 17799, 914.51),
        new Zone3ProgressiveTwoDto(17800, 69878, 173.10, 1034.87),
        new Zone4TopRateDto(69879, 277825, 11135.63),
        new Zone5WealthRateDto(277826, 19470.38),
    ],
];