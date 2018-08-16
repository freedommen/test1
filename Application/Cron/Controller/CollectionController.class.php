<?php
namespace Cron\Controller;
use Think\Controller;
use Cron\Model\CollectionModel;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/8
 * Time: 10:29
 */
class CollectionController extends Controller{
    /**ff_ticket_day
     *每日售票量
     */
    public function addTicket(){
        $date = '20170601';
        $model = new CollectionModel();
        while(20170601<=$date && $date<=20181231){
            $data = $model->addTicket($date);
            $date = date('Ymd',strtotime("$date +1 day"));
        }
    }
    /**ff_visitor_real
     * ff_scenic_flow_day
     * 景区实时客流
     */
    public function addVisitorReal(){
        $date = '20170601';
        $model = new CollectionModel();
        while(20170601<=$date && $date<=20181231){
            $data = $model->addVisitorReal($date);
            $date = date('Ymd',strtotime("$date +1 day"));
        }
    }
    /**ff_forecast_area
     * ff_forecast_flow
     * 客流预测
     */
    public function addCustomerFlow(){
        $date = '20170601';
        $model = new CollectionModel();
        while(20170601<=$date && $date<=20181231){
            $data = $model->addCustomerFlow($date);
            $date = date('Ymd',strtotime("$date +1 day"));
        }
    }
    /**ff_consume_paytype
     * 支付方式
     */
    public function addPayType(){
        $date = '20170601';
        $money = 10000;//消费总金额
        $model = new CollectionModel();
        while(20170601<=$date && $date<=20181231){
            $data = $model->addPayType($date,$money);
            $date = date('Ymd',strtotime("$date +1 day"));
        }
    }
    /**ff_consume_total
     * 消费金额
     */
    public function addPayMoney(){
        $date = '20170601';
        $money = 10000;//消费总金额
        $model = new CollectionModel();
        while(20170601<=$date && $date<=20181231){
            $data = $model->addPayMoney($date,$money);
            $date = date('Ymd',strtotime("$date +1 day"));
        }
    }
    /**ff_consume_channel
     * 消费分布
     */
    public function addPayDistribution(){
        $date = '20170601';
        $money = 10000;//消费总金额
        $model = new CollectionModel();
        while(20170601<=$date && $date<=20181231){
            $data = $model->addPayDistribution($date,$money);
            $date = date('Ymd',strtotime("$date +1 day"));
        }
    }
    /**ff_complain_area
     * ff_complain
     * 投诉分析
     */
    public function addComplainArea(){
        $date = '20170601';
        $model = new CollectionModel();
        while(20170601<=$date && $date<=20181231){
            $data = $model->addComplainArea($date);
            $date = date('Ymd',strtotime("$date +1 day"));
        }
    }


    /**ff_ticket_reservations
     * 提前购票数量
     */
    public function addTicketReservations(){
        $date = '20170601';
        $model = new CollectionModel();
        while(20170601<=$date && $date<=20181231){
            $data = $model->addTicketReservations($date);
            $date = date('Ymd',strtotime("$date +1 day"));
        }
    }

    /**ff_ticket_channel
     * 票务预订渠道统计
     */
    public function addTicketChannel(){
        $date = '20170601';
        $model = new CollectionModel();
        while(20170601<=$date && $date<=20181231){
            $data = $model->addTicketChannel($date);
            $date = date('Ymd',strtotime("$date +1 day"));
        }
    }
    /**ff_ticket_type_day
     * 售票类型
     */
    public function addTicketType(){
        $date = '20170601';
        $model = new CollectionModel();
        while(20170601<=$date && $date<=20181231){
            $data = $model->addTicketType($date);
            $date = date('Ymd',strtotime("$date +1 day"));
        }
    }
    /**ff_ticket_total
     * 售票渠道
     */
    public function addTicketTotal(){
        $date = '20170601';
        $money = 98;//总金额
        $model = new CollectionModel();
        while(20170601<=$date && $date<=20181231){
            $data = $model->addTicketTotal($date,$money);
            $date = date('Ymd',strtotime("$date +1 day"));
        }
    }

    /**ff_ticket_pay
     * 支付方式
     */
    public function addTicketPay(){
        $date = '20170601';
        $model = new CollectionModel();
        while(20170601<=$date && $date<=20181231){
            $data = $model->addTicketPay($date);
            $date = date('Ymd',strtotime("$date +1 day"));
        }
    }

    /**ff_scenic_flow_area
     * 游客客源地表-地区（每天）
     */
    public function addFlowArea(){
        $date = '20170601';
        $model = new CollectionModel();
        while(20170601<=$date && $date<=20181231){
            $data = $model->addFlowArea($date);
            $date = date('Ymd',strtotime("$date +1 day"));
        }
    }

    /**
     * ff_visitor_sex
     * ff_visitor_age
     * 游客年龄性别
     */
    public function addVisitorAgeSex(){
        $date = '20170601';
        $model = new CollectionModel();
        while(20170601<=$date && $date<=20181231){
            $data = $model->addVisitorAgeSex($date);
            $date = date('Ymd',strtotime("$date +1 day"));
        }
    }
    /**
     * ff_visitor_stay
     * 游客平均停留时间
     */
    public function addVisitorStay(){
        $date = '20170601';
        $model = new CollectionModel();
        while(20170601<=$date && $date<=20181231){
            $data = $model->addVisitorStay($date);
            $date = date('Ymd',strtotime("$date +1 day"));
        }
    }

    /**ff_scenic_car_real
     * 景区实时车流
     */
    public function addScenicCarReal(){
        $date = '20170601';
        $model = new CollectionModel();
        while(20170601<=$date && $date<=20181231){
            $data = $model->addScenicCarReal($date);
            $date = date('Ymd',strtotime("$date +1 day"));
        }
    }
    /**
     * ff_scenic_flow_total
     * 景区客流汇总
     */
    public function addScenicFlowTotal(){
        $date = '20170601';
        $model = new CollectionModel();
        while(20170601<=$date && $date<=20181231){
            $data = $model->addScenicFlowTotal($date);
            $date = date('Ymd',strtotime("$date +1 day"));
        }
    }
    /**
     * ff_scenic_car
     * 景区车流汇总
     */
    public function addScenicCar(){
        $date = '20170601';
        $model = new CollectionModel();
        while(20170601<=$date && $date<=20181231){
            $data = $model->addScenicCar($date);
            $date = date('Ymd',strtotime("$date +1 day"));
        }
    }
    /**
     * ff_scenic_car_stay
     * 景区车流汇总
     */
    public function addScenicCarStay(){
        $date = '20170601';
        $model = new CollectionModel();
        while(20170601<=$date && $date<=20181231){
            $data = $model->addScenicCarStay($date);
            $date = date('Ymd',strtotime("$date +1 day"));
        }
    }
    public function getIntance(){
        ini_set('max_execution_time', '0');
        $this->addTicket();
        $this->addVisitorReal();
        $this->addCustomerFlow();
        $this->addPayType();
        $this->addPayMoney();
        $this->addPayDistribution();
        $this->addComplainArea();
        $this->addTicketReservations();
        $this->addTicketChannel();
        $this->addTicketType();
        $this->addTicketTotal();
        $this->addTicketPay();
        $this->addFlowArea();
        $this->addVisitorAgeSex();
        $this->addVisitorStay();
        $this->addScenicCarReal();
        $this->addScenicFlowTotal();
        $this->addScenicCar();
        $this->addScenicCarStay();
        die('执行完毕');
    }
}