USE inet;

drop table if exists DETAIL_PESANAN;

drop table if exists LANGANAN;

drop table if exists MEMBER;

drop table if exists PESANAN;

drop table if exists PRODUK;

drop table if exists TIPE_PRODUK;

create table MEMBER
(
   USER_ID              int not null auto_increment,
   NAMA                 varchar(30) not null,
   PASSWORD             varchar(30) not null,
   EMAIL                varchar(30) not null,
   ALAMAT               varchar(50) not null,
   TIPE_USER            int,
   primary key (USER_ID)
);

/*==============================================================*/
/* Table: DETAIL_PESANAN                                        */
/*==============================================================*/
create table DETAIL_PESANAN
(
   KODE_PESANAN         int not null,
   ID_PRODUK            int not null,
   KETERANGAN           char(10),
   BIAYA                int,
   DISKON               int,
);

/*==============================================================*/
/* Table: LANGANAN                                              */
/*==============================================================*/
create table LANGANAN
(
   ID_LANGANAN          int not null auto_increment,
   USER_ID               int,
   NAMA_LANGGANAN       varchar(30) not null,
   TANGGAL_MULAI        date not null,
   JUMLAH_HARI          int not null,
   STATUS               int not null,
   primary key (ID_LANGANAN)
);

/*==============================================================*/
/* Table: MEMBER                                                */
/*==============================================================*/


/*==============================================================*/
/* Table: PESANAN                                               */
/*==============================================================*/
create table PESANAN
(
   KODE_PESANAN         int not null auto_increment,
   USER_ID               int,
   TGL_PESANAN          date,
   KETERANGAN           varchar(100) not null,
   PERKIRAAN_BIAYA      int not null,
   ALAMAT               varchar(50) not null,
   STATUS               int not null,
   primary key (KODE_PESANAN)
);

/*==============================================================*/
/* Table: PRODUK                                                */
/*==============================================================*/
create table PRODUK
(
   ID_PRODUK            int not null auto_increment,
   ID_LANGANAN          int,
   ID_TIPE              int,
   TIPE_PRODUK          int not null,
   NAMA_PRODUK          varchar(30) not null,
   BIAYA                int not null,
   DISKON               int,
   primary key (ID_PRODUK)
);

/*==============================================================*/
/* Table: TIPE_PRODUK                                           */
/*==============================================================*/
create table TIPE_PRODUK
(
   ID_TIPE              int not null auto_increment,
   NAMA_PRODUK          varchar(30) not null,
   primary key (ID_TIPE)
);

alter table DETAIL_PESANAN add constraint FK_DETAIL_PESANAN foreign key (KODE_PESANAN)
      references PESANAN (KODE_PESANAN) on delete restrict on update restrict;

alter table DETAIL_PESANAN add constraint FK_DETAIL_PESANAN2 foreign key (ID_PRODUK)
      references PRODUK (ID_PRODUK) on delete restrict on update restrict;

alter table LANGANAN add constraint FK_RELATIONSHIP_2 foreign key (USER_ID)
      references MEMBER (USER_ID) on delete restrict on update restrict;

alter table PESANAN add constraint FK_RELATIONSHIP_1 foreign key (USER_ID)
      references MEMBER (USER_ID) on delete restrict on update restrict;

alter table PRODUK add constraint FK_RELATIONSHIP_4 foreign key (ID_LANGANAN)
      references LANGANAN (ID_LANGANAN) on delete restrict on update restrict;

alter table PRODUK add constraint FK_RELATIauto_incrementONSHIP_5 foreign key (ID_TIPE)
      references TIPE_PRODUK (ID_TIPE) on delete restrict on update restrict;

