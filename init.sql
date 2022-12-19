create table Subject
(
    Id SERIAL PRIMARY KEY,
    Name VARCHAR(100) NOT NULL
);

create table Lector
(
    Id SERIAL PRIMARY KEY,
    Name VARCHAR(100) NOT NULL
);

create table "group"
(
    Id SERIAL primary key,
    Name varchar(15) not null
);

create table Student
(
    Id int primary key,
    GroupId int not null references "group"(Id) on delete cascade
);

CREATE TYPE WeekType AS ENUM
('Numerator', 'Denominator', 'Both');

create table Schedule
(
    Id SERIAL primary key,
    GroupId int not null references "group"(Id) on delete cascade,
    LectorId int not null references Lector(Id) on delete cascade,
    SubjectId int not null references Subject(Id) on delete cascade,
    Classroom int,
    DayOfWeek int not null check (DayOfWeek >= 0 AND DayOfWeek < 7),
    Address varchar(150),
    Week WeekType not null,
    StartTime time not null,
    EndTime time not null
);

create table Attendance
(
    ScheduleId int not null references Schedule(Id) on delete cascade,
    StudentId int not null references Student(Id) on delete cascade,
    SkippedClassNumber int default 0,
    primary key (ScheduleId, StudentId)
);

insert into "group"
    (name)
values('ПМИ-41');
insert into "group"
values(2, 'ПМИ-42');
insert into "group"
values(3, 'МКН-41');
insert into "group"
values(4, 'ИБ-41');
insert into "group"
values(5, 'КБ-41');

insert into subject
values(1, 'Информационные технологии');
insert into subject
values(2, 'Криптографические методы защиты информации');
insert into subject
values(3, 'Техническая защита информации');
insert into subject
values(4, 'Безопасность систем баз данных');
insert into subject
values(5, 'Безопасность компьютерных сетей');
insert into subject
values(6, 'Основы управления информационной безопасностью');
insert into subject
values(7, 'Комплексная защита объектов информатизации');
insert into subject
values(8, 'Сети и системы передачи информации');

insert into subject
values(9, 'Вероятностные алгоритмы');
insert into subject
values(10, 'Системы управления базами данных');
insert into subject
values(11, 'Правоведение');
insert into subject
values(12, 'Психология');
insert into subject
values(13, 'Аппаратные средства вычислительной техники');
insert into subject
values(14, 'Алгебраические структуры');
insert into subject
values(15, 'Основы информационной безопасности');

insert into subject
values(16, 'Теория изображений');
insert into subject
values(17, 'Компьютерная гидродинамика');
insert into subject
values(18, 'Методы оптимизации');
insert into subject
values(19, 'Комбинаторная оптимизация');
insert into subject
values(20, 'Теоретическая механика');
insert into subject
values(21, 'ПМП и ММ');
insert into subject
values(22, 'Физика');
insert into subject
values(23, 'Основы права');
insert into subject
values(24, 'Теория изображений');


insert into subject
values(25, 'ГТДС');
insert into subject
values(26, 'Вычислительная алгебра');
insert into subject
values(27, 'Теория уравнений с запаздыванием');
insert into subject
values(28, 'ДГЧМ');
insert into subject
values(29, 'Прикладной функциональный анализ');
insert into subject
values(30, 'Выпуклое программирование');
insert into subject
values(31, 'Математическое моделирование');
insert into subject
values(32, 'Функциональное программирование');
insert into subject
values(33, 'Динамика дискретных систем');
insert into subject
values(34, 'ИЗВМ');
insert into subject
values(35, 'Динамические системы и случайные процессы');
insert into subject
values(36, 'Суперкомпьютерные технологии и основы ИИ');
insert into subject
values(37, 'Всплесковый анализ');
insert into subject
values(38, 'Задачи аппроксимации');
insert into subject
values(39, 'Визуальные системы');


insert into lector
    (name)
values('Власова О.В.');
insert into lector
    (name)
values('Ухалов А.Ю.');
insert into lector
    (name)
values('Сорокина М.Е.');
insert into lector
    (name)
values('Очиров А.А.');
insert into lector
    (name)
values('Бизин О.Е.');
insert into lector
    (name)
values('Саханда А.В.');
insert into lector
    (name)
values('Захаров А.С.');
insert into lector
    (name)
values('Белов А.Р.');
insert into lector
    (name)
values('Казанков С.П.');
insert into lector
    (name)
values('Кашапов А.С.');
insert into lector
    (name)
values('Афонин А.А.');
insert into lector
    (name)
values('Савинов Д.А.');
insert into lector
    (name)
values('Тимофеева Н.В.');


insert into lector
    (name)
values('Никулина Е.В.');
insert into lector
    (name)
values('Литвинов В.В.');
insert into lector
    (name)
values('Климов В.С.');
insert into lector
    (name)
values('Гринев Д.В.');
insert into lector
    (name)
values('Алексеев В.В.');
insert into lector
    (name)
values('Секацкая А.В.');
insert into lector
    (name)
values('Иродова И.П.');
insert into lector
    (name)
values('Мазалецкий Л.А.');
insert into lector
    (name)
values('Кулев А.Г.');

insert into lector
    (name)
values('Умнова И.В.');
insert into lector
    (name)
values('Майорова Н.Л.');
insert into lector
    (name)
values('Глазков Д.В.');
insert into lector
    (name)
values('Кащенко И.С.');
insert into lector
    (name)
values('Преображенский И.Е.');
insert into lector
    (name)
values('Зеркалина Е.И.');
insert into lector
    (name)
values('Глызин Д.С.');
insert into lector
    (name)
values('Смирнова М.В.');

insert into schedule
values(1, 4, 1, 4, 403, 0, null, 'Both', '09:00', '10:35');
insert into schedule
values(2, 4, 2, 1, 402, 0, null, 'Both', '10:45', '12:20');
insert into schedule
values(3, 4, 3, 2, 319, 0, null, 'Both', '13:20', '14:55');

insert into schedule
values(4, 4, 4, 3, 432, 2, null, 'Both', '09:00', '10:35');
insert into schedule
values(5, 4, 4, 3, 432, 2, null, 'Both', '13:20', '14:55');
