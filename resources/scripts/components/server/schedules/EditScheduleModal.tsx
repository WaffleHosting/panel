import React, { useContext, useEffect, useState } from "react";
import { Schedule } from "@/api/server/schedules/getServerSchedules";
import Field from "@/components/elements/Field";
import { Form, Formik, FormikHelpers } from "formik";
import FormikSwitch from "@/components/elements/FormikSwitch";
import createOrUpdateSchedule from "@/api/server/schedules/createOrUpdateSchedule";
import { ServerContext } from "@/state/server";
import { httpErrorToHuman } from "@/api/http";
import FlashMessageRender from "@/components/FlashMessageRender";
import useFlash from "@/plugins/useFlash";
import tw from "twin.macro";
import { Button } from "@/components/elements/button/index";
import ModalContext from "@/context/ModalContext";
import asModal from "@/hoc/asModal";
import Switch from "@/components/elements/Switch";
import ScheduleCheatsheetCards from "@/components/server/schedules/ScheduleCheatsheetCards";

interface Props {
  schedule?: Schedule;
}

interface Values {
  name: string;
  dayOfWeek: string;
  month: string;
  dayOfMonth: string;
  hour: string;
  minute: string;
  enabled: boolean;
  onlyWhenOnline: boolean;
}

const EditScheduleModal = ({ schedule }: Props) => {
  const { addError, clearFlashes } = useFlash();
  const { dismiss } = useContext(ModalContext);

  const uuid = ServerContext.useStoreState((state) => state.server.data!.uuid);
  const appendSchedule = ServerContext.useStoreActions((actions) => actions.schedules.appendSchedule);
  const [showCheatsheet, setShowCheetsheet] = useState(false);

  useEffect(() => {
    return () => {
      clearFlashes("schedule:edit");
    };
  }, []);

  const submit = (values: Values, { setSubmitting }: FormikHelpers<Values>) => {
    clearFlashes("schedule:edit");
    createOrUpdateSchedule(uuid, {
      id: schedule?.id,
      name: values.name,
      cron: {
        minute: values.minute,
        hour: values.hour,
        dayOfWeek: values.dayOfWeek,
        month: values.month,
        dayOfMonth: values.dayOfMonth,
      },
      onlyWhenOnline: values.onlyWhenOnline,
      isActive: values.enabled,
    })
      .then((schedule) => {
        setSubmitting(false);
        appendSchedule(schedule);
        dismiss();
      })
      .catch((error) => {
        console.error(error);

        setSubmitting(false);
        addError({ key: "schedule:edit", message: httpErrorToHuman(error) });
      });
  };

  return (
    <Formik
      onSubmit={submit}
      initialValues={
        {
          name: schedule?.name || "",
          minute: schedule?.cron.minute || "*/5",
          hour: schedule?.cron.hour || "*",
          dayOfMonth: schedule?.cron.dayOfMonth || "*",
          month: schedule?.cron.month || "*",
          dayOfWeek: schedule?.cron.dayOfWeek || "*",
          enabled: schedule?.isActive ?? true,
          onlyWhenOnline: schedule?.onlyWhenOnline ?? true,
        } as Values
      }
    >
      {({ isSubmitting }) => (
        <Form>
          <h3 css={tw`text-2xl mb-6`}>{schedule ? "แก้ไขกำหนดการ" : "สร้างกำหนดการใหม่"}</h3>
          <FlashMessageRender byKey={"schedule:edit"} css={tw`mb-6`} />
          <Field name={"name"} label={"ชื่อ กำหนดการ"} description={"ตัวระบุที่สามารถอ่านได้โดยมนุษย์"} />
          <div css={tw`grid grid-cols-2 sm:grid-cols-5 gap-4 mt-6`}>
            <Field name={"minute"} label={"นาที"} />
            <Field name={"hour"} label={"ชั่วโมง"} />
            <Field name={"dayOfMonth"} label={"วันของเดือน"} />
            <Field name={"month"} label={"เดือน"} />
            <Field name={"dayOfWeek"} label={"วันของสัปดาห์"} />
          </div>
          <p css={tw`text-neutral-400 text-xs mt-2`}>
            ระบบกำหนดการ (schedule system) รองรับการใช้รูปแบบของ Cronjob syntax เมื่อกำหนดเวลาที่ต้องการให้งานเริ่มทำงาน
            โดยใช้ฟิลด์ข้างต้นเพื่อระบุเวลาที่งานควรเริ่มทำงาน
          </p>
          <div css={tw`mt-6 bg-[#070707] border border-neutral-800 shadow-inner p-4 rounded`}>
            <Switch
              name={"show_cheatsheet"}
              description={"แสดง Cron Cheatsheet สำหรับตัวอย่างบางอย่าง"}
              label={"แสดงแผนภูมิคำสั่ง"}
              defaultChecked={showCheatsheet}
              onChange={() => setShowCheetsheet((s) => !s)}
            />
            {showCheatsheet && (
              <div css={tw`block md:flex w-full`}>
                <ScheduleCheatsheetCards />
              </div>
            )}
          </div>
          <div css={tw`mt-6 bg-[#070707] border border-neutral-800 shadow-inner p-4 rounded`}>
            <FormikSwitch
              name={"onlyWhenOnline"}
              description={"กระทำตามตารางนี้เฉพาะเมื่อเซิร์ฟเวอร์อยู่ในสถานะการทำงานอยู่เท่านั้น"}
              label={"เฉพาะเมื่อเซิร์ฟเวอร์อยู่ในสถานะออนไลน์เท่านั้น"}
            />
          </div>
          <div css={tw`mt-6 bg-[#080808] border border-neutral-800 shadow-inner p-4 rounded`}>
            <FormikSwitch
              name={"enabled"}
              description={"ตารางนี้จะถูกดำเนินการโดยอัตโนมัติหากได้เปิดใช้งานแล้ว"}
              label={"ตารางถูกเปิดใช้งาน"}
            />
          </div>
          <div css={tw`mt-6 text-right`}>
            <Button className={"w-full sm:w-auto"} type={"submit"} disabled={isSubmitting}>
              {schedule ? "บันทึกการเปลี่ยนแปลง" : "สร้างกำหนดการ"}
            </Button>
          </div>
        </Form>
      )}
    </Formik>
  );
};

export default asModal<Props>()(EditScheduleModal);
