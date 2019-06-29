<?php

use App\Models\Service;
use App\Models\Service_image;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $branches =
            [

            [
                "services" =>
                [

                    [
                        "name" => "تحويل أموال",
                        "description" => "تحويل مبلغ من المركز إلى أي فرع من فروعنا , حيث نأخذ نسبة معينة من المال",
                        "time" => 2,
                        "requirements" => "محاسبة,حاسوب,شخص اجتماعي",
                        "branch_id" => 1,
                        "image" => "assets/uploads/branches/1/services/sendMoney.jpg",
                    ],
                    [
                        "name" => "استقبال أموال",
                        "description" => "يمكنك استقبال مبلغ مالي , يجب عليك إحضار هويتك فقط , ومعرفة المبلغ المحول لك",
                        "time" => 1,
                        "requirements" => "محاسبة,حاسوب,شخص اجتماعي",
                        "branch_id" => 1,
                        "image" => "assets/uploads/branches/1/services/receiveMoney.jpg",
                    ],
                ],
            ],
            [
                "services" =>
                [
                    [
                        "name" => "تحويل أموال",
                        "description" => "تحويل مبلغ من المركز إلى أي فرع من فروعنا , حيث نأخذ نسبة معينة من المال",
                        "time" => 2,
                        "requirements" => "محاسبة,حاسوب,شخص اجتماعي",
                        "branch_id" => 2,
                        "image" => "assets/uploads/branches/2/services/sendMoney.jpg",
                    ],
                    [
                        "name" => "استقبال أموال",
                        "description" => "يمكنك استقبال مبلغ مالي , يجب عليك إحضار هويتك فقط , ومعرفة المبلغ المحول لك",
                        "time" => 2,
                        "requirements" => "محاسبة,حاسوب,شخص اجتماعي",
                        "branch_id" => 2,
                        "image" => "assets/uploads/branches/2/services/receiveMoney.jpg",
                    ],
                    [
                        "name" => "دفع فواتير",
                        "description" => "يمكنك دفع الفواتير المترتبة عليك ... كهرباء , ماء الخ , وذلك بإبراز الأوراق الثبوتية",
                        "time" => 1,
                        "requirements" => "محاسبة,حاسوب,شخص اجتماعي,إكسل,إنترنت",
                        "branch_id" => 2,
                        "image" => "assets/uploads/branches/2/services/payBill.jpg",
                    ],
                ],
            ],
            [
                "services" =>
                [
                    [
                        "name" => "شراء خط",
                        "description" => "شراء خط جديد , وتعبئة رصيد , كما يمكنك الاستفادة من العروض الجديدة",
                        "time" => 2,
                        "requirements" => "قانون,محاسبة,إكسل,وورد,حاسوب",
                        "branch_id" => 3,
                        "image" => "assets/uploads/branches/3/services/buyCall.jpg",
                    ],
                    [
                        "name" => "دفع فاتورة",
                        "description" => "دفع فاتورة خطك بأسرع وقت , ينبغي عليك أن تجلب هويتك الشخصية و رقم هاتفك",
                        "time" => 1,
                        "requirements" => "محاسبة,حاسوب,شخص اجتماعي",
                        "branch_id" => 3,
                        "image" => "assets/uploads/branches/3/services/payBill.jpg",
                    ],
                   
                ],
            ],
            [
                "services" =>
                [
                    [
                        "name" => "شراء خط",
                        "description" => "شراء خط جديد , وتعبئة رصيد , كما يمكنك الاستفادة من العروض الجديدة",
                        "time" => 2,
                        "requirements" => "قانون,محاسبة,إكسل,وورد,حاسوب",
                        "branch_id" => 4,
                        "image" => "assets/uploads/branches/4/services/buyCall.jpg",
                    ],
                    [
                        "name" => "دفع فاتورة",
                        "description" => "دفع فاتورة خطك بأسرع وقت , ينبغي عليك أن تجلب هويتك الشخصية و رقم هاتفك",
                        "time" => 2,
                        "requirements" => "محاسبة,حاسوب,شخص اجتماعي",
                        "branch_id" => 4,
                        "image" => "assets/uploads/branches/4/services/payBill.jpg",
                    ],
                    [
                        "name" => "استعلامات",
                        "description" => "نحن موجودين معك في طول  فترة افتتاح المركز للإجابة عن أي استفسار",
                        "time" => 3,
                        "requirements" => "حاسوب,شخص اجتماعي",
                        "branch_id" => 4,
                        "image" => "assets/uploads/branches/4/services/calling.jpg",
                    ],
                   
                ],
            ],

        ];

        foreach ($branches as $branch) {
            foreach ($branch["services"] as $service) {
                $new_service = new Service();
                $new_service->name = $service['name'];
                $new_service->description = $service['description'];
                $new_service->time = $service['time'];
                $new_service->requirements = $service['requirements'];
                $new_service->branch_id = $service['branch_id'];
                $new_service->save();

                $new_service_image = new Service_image();
                $new_service_image->path = $service['image'];
                $new_service_image->service_id = $new_service->id;
                $new_service_image->save();
            }
        }

    }
}
