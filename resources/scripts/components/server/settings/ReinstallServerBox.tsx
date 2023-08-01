import React, { useEffect, useState } from "react";
import { ServerContext } from "@/state/server";
import TitledGreyBox from "@/components/elements/TitledGreyBox";
import reinstallServer from "@/api/server/reinstallServer";
import { Actions, useStoreActions } from "easy-peasy";
import { ApplicationStore } from "@/state";
import { httpErrorToHuman } from "@/api/http";
import tw from "twin.macro";
import { Button } from "@/components/elements/button/index";
import { Dialog } from "@/components/elements/dialog";

export default () => {
  const uuid = ServerContext.useStoreState((state) => state.server.data!.uuid);
  const [modalVisible, setModalVisible] = useState(false);
  const { addFlash, clearFlashes } = useStoreActions((actions: Actions<ApplicationStore>) => actions.flashes);

  const reinstall = () => {
    clearFlashes("settings");
    reinstallServer(uuid)
      .then(() => {
        addFlash({
          key: "settings",
          type: "success",
          message: "Your server has begun the reinstallation process.",
        });
      })
      .catch((error) => {
        console.error(error);

        addFlash({ key: "settings", type: "error", message: httpErrorToHuman(error) });
      })
      .then(() => setModalVisible(false));
  };

  useEffect(() => {
    clearFlashes();
  }, []);

  return (
    <TitledGreyBox title={"ติดตั้งเซิร์ฟเวอร์ใหม่"} css={tw`relative`}>
      <Dialog.Confirm
        open={modalVisible}
        title={"ยืนยันการติดตั้งเซิร์ฟเวอร์ใหม่"}
        confirm={"ตกลง"}
        onClose={() => setModalVisible(false)}
        onConfirmed={reinstall}
      >
        เซิร์ฟเวอร์ของคุณจะถูกหยุดทำงานและบางไฟล์อาจถูกลบหรือแก้ไขในระหว่างกระบวนการนี้
        คุณแน่ใจหรือไม่ที่ต้องการดำเนินการต่อ?
      </Dialog.Confirm>
      <p css={tw`text-sm`}>
        การติดตั้งใหม่เซิร์ฟเวอร์ของคุณจะหยุดทำงาน และจากนั้นจะรันสคริปต์ติดตั้งใหม่ที่ตั้งค่าเริ่มต้น&nbsp;
        <strong css={tw`font-medium`}>
          ในกระบวนการนี้อาจมีการลบหรือแก้ไขไฟล์บางส่วน โปรดสำรองข้อมูลของคุณก่อนดำเนินการต่อ
        </strong>
      </p>
      <div css={tw`mt-6 text-right`}>
        <Button.Danger variant={Button.Variants.Secondary} onClick={() => setModalVisible(true)}>
          ติดตั้งเซิร์ฟเวอร์ใหม่
        </Button.Danger>
      </div>
    </TitledGreyBox>
  );
};
