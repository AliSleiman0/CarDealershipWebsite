<?php
 require_once('DAL.class.php');
class Coupon extends DAL
{
    public function applyCoupon($customerID, $couponCode)
    {
        $sql = "SELECT * FROM coupon WHERE code = ? AND status = 'active' AND valid_from <= CURDATE() AND valid_until >= CURDATE() AND times_used < usage_limit";
        $result = $this->data($sql, [$couponCode]);

        if (!empty($result)) {
            return ['success' => true, 'coupon' => $result[0]];
        } else {
            return ['success' => false, 'message' => 'Invalid or expired coupon code.'];
        }
    }

    public function calculateTotalAmount($inventory)
    {
        $total = 0;
        foreach ($inventory as $carId => $colors) {
            $carPrice = $this->getCarPrice($carId);
            foreach ($colors as $color => $quantity) {
                $total += $carPrice * $quantity;
            }
        }
        return $total;
    }

    private function getCarPrice($carId)
    {
        $sql = "SELECT Price FROM cars WHERE CarID = ?";
        $result = $this->data($sql, [$carId]);
        return !empty($result) ? $result[0]['Price'] : 0;
    }
}
